<?php

namespace App\Http\Controllers;

use App\Events\BookingCodeProcessed;
use App\Events\BookingDetail;
use App\Events\DoneEvent;
use App\Events\GuideEvent;
use Illuminate\Http\Request;
use Pusher\Pusher;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        return view('booking.index');
    }

    public function process(Request $request)
    {
        $database = app('firebase.database');
        $transactions = $database->getReference('transactions');

        $bookingCode = $request->input('bookingCode');

        $transactionData = null;
        $transactionSnapshot = $transactions->getValue();

        foreach($transactionSnapshot as $key => $data)
        {
            if(isset($data['bookingCode']) && $data['bookingCode'] == $bookingCode && $data['status'] === 'SUCCESS') 
            {
                $transactionData = $data;
                break;
            }
        }

        
        if(!$transactionData)
        {
            return redirect()->back()->with('error', 'Terjadi error atau kode booking tidak valid');
        } 
        
        event(new BookingCodeProcessed($transactionData, $key));

        return redirect()->route('booking.detail', ['id' => $key, 'data' => $transactionData]);
    }

    public function detail($id)
    {
        $database = app('firebase.database');
        $booking = $database->getReference('transactions/'.$id);
        $bookingData = $booking->getValue();

        $auth = app('firebase.auth');
        $user = $auth->getUser($bookingData['user_id']);
        // dd($user);

        return view('booking.detail', [
            'id' => $id,
            'bookingData' => $bookingData,
            'user' => $user
        ]);
    }

    public function setupguide1($id)
    {
        //code
        $database = app('firebase.database');
        $transactionRef = $database->getReference('transactions/'.$id);

        //step 1
        $transactionData = $transactionRef->getValue();

        //step 2
        $bookedStatusRef = $database->getReference('Booked Status');
        $bookedStatusData = $bookedStatusRef->getValue(); 
        $spbkluRef = $database->getReference('SPBKLU');
        $spbkluData = $spbkluRef->getValue();

        $selectedSlot = null;   

        foreach($bookedStatusData as $slot => $status)
        {
            if($status === 'Empty'){
                $selectedSlot = $slot;
                break;
            }
        }

        // dd($selectedSlot);

        if($selectedSlot)
        {
            $doorsRef = $database->getReference('doors/'.$selectedSlot);
            $doorsRef->set(1);

            event(new BookingDetail($selectedSlot, $id));
        }
        
        return view('booking.guide1', [
            'id' => $id,
            'selectedSlot' => $selectedSlot
        ]);
    }

    public function setupguide2($id)
    {
        //code
        $database = app('firebase.database');
        $transactionRef = $database->getReference('transactions/'.$id);

        //step 1
        $transactionData = $transactionRef->getValue();
        // dd($transactionData);
        //step 2
        $slot = $transactionData['slot'];

        if($slot)
        {
            $doorsRef = $database->getReference('doors/'.$slot);
            $doorsRef->set(1);

            event(new GuideEvent($slot));
        }
        
        return view('booking.guide2', [
            'id' => $id,
            'selectedSlot' => $slot
        ]);
    }

    public function done($id)
    {
        $database = app('firebase.database');
        $transactionRef = $database->getReference('transactions/'.$id);

        //step 1
        $transactionData = $transactionRef->getValue();
        // dd($transactionData);
        //step 2
        $slot = $transactionData['slot'];

        if($slot)
        {
            $doorsRef = $database->getReference('doors/'.$slot);
            $doorsRef->set(0);
        }

        $transactionRef->update([
            'status' => 'DONE'
        ]);

        event(new DoneEvent());
        
        return redirect()->route('booking.index');

    }

    public function api_setupguide1($id)
    {
        //code
        $database = app('firebase.database');
        $transactionRef = $database->getReference('transactions/'.$id);

        //step 1
        $transactionData = $transactionRef->getValue();

        //step 2
        $bookedStatusRef = $database->getReference('Booked Status');
        $bookedStatusData = $bookedStatusRef->getValue(); 
        $spbkluRef = $database->getReference('SPBKLU');
        $spbkluData = $spbkluRef->getValue();

        $selectedSlot = null;   

        foreach($bookedStatusData as $slot => $status)
        {
            if($status === 'Empty'){
                $selectedSlot = $slot;
                break;
            }
        }

        // dd($selectedSlot);

        if($selectedSlot)
        {
            $doorsRef = $database->getReference('doors/'.$selectedSlot);
            $doorsRef->set(1);
        }
        
        return view('api.guide1', [
            'id' => $id,
            'selectedSlot' => $selectedSlot
        ]);
    }

    public function api_setupguide2($id)
    {
        //code
        $database = app('firebase.database');
        $transactionRef = $database->getReference('transactions/'.$id);

        //step 1
        $transactionData = $transactionRef->getValue();
        // dd($transactionData);
        //step 2
        $slot = $transactionData['slot'];

        if($slot)
        {
            $doorsRef = $database->getReference('doors/'.$slot);
            $doorsRef->set(1);
        }
        
        return view('api.guide2', [
            'id' => $id,
            'selectedSlot' => $slot
        ]);
    }

    public function api_done($id)
    {
        $database = app('firebase.database');
        $transactionRef = $database->getReference('transactions/'.$id);

        //step 1
        $transactionData = $transactionRef->getValue();
        // dd($transactionData);
        //step 2
        $slot = $transactionData['slot'];

        if($slot)
        {
            $doorsRef = $database->getReference('doors/'.$slot);
            $doorsRef->set(0);
        }

        $transactionRef->update([
            'status' => 'DONE'
        ]);
        
        return redirect()->route('monitor.index');

    }

}
