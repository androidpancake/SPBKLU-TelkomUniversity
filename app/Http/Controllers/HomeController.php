<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Contract\Auth;
use Kreait\Firebase\Exception\FirebaseException;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      // FirebaseAuth.getInstance().getCurrentUser();
      try {
        $uid = Session::get('uid');
        $user = app('firebase.auth')->getUser($uid);
        $database = app('firebase.database');
        
        $transactions = $database->getReference('transactions')->getSnapshot()->getValue();
        
        $successSlots = [];

        
        foreach($transactions as $transaction){
            if(isset($transaction['status']) && $transaction['status'] === 'SUCCESS')
            {
                $successSlots[] = $transaction['slot'];
            }
        }
        
        $slotData = $database->getReference('SPBKLU')->getSnapshot()->getValue();
        
        foreach($slotData as $slotKey => $data)
        {
            if(in_array($slotKey, $successSlots))
            {
                continue;
            }
            if(isset($data['Slot Status']) && $data['Slot Status'] === 'Ready'){
                $database->getReference('Booked Status/'.$slotKey)->set('Ready');
            }

            if(isset($data['Slot Status']) && $data['Slot Status'] === 'Charging'){
                $database->getReference('Booked Status/'.$slotKey)->set('Charging');
            }

            if(isset($data['Slot Status']) && $data['Slot Status'] === 'Empty'){
                $database->getReference('Booked Status/'.$slotKey)->set('Empty');
            }
        }
        // dd($user);
        return view('home', compact('user'));
      } catch (\Exception $e) {
        return $e;
      }

    }

    public function landing()
    {
      try {
        $uid = Session::get('uid');
        $user = app('firebase.auth')->getUser($uid);
        // dd($user);
        return view('landing', compact('user'));
      } catch (\Exception $e) {
        return $e;
      }
    }

    public function customer()
    {
      $userid = Session::get('uid');
      return view('customers',compact('userid'));
    }
}
