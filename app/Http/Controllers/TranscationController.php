<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Str;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Auth;
use Illuminate\Support\Facades\Session;
use Midtrans\Config;
use Midtrans\Snap;


use Illuminate\Http\Request;
use Kreait\Firebase\Exception\DatabaseException;
use Nette\Utils\Random;

class TranscationController extends Controller
{
    protected $database;
    
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    
    public function process($id)
    {
        $uid = Session::get('uid');
        $user = app('firebase.auth')->getUser($uid);

        if($user)
        {
            $database = app('firebase.database');
            $slotStation = $database->getReference('Booked Status');
            $slotData = $slotStation->getValue();
            $station = $database->getReference('Station/'.$id);
            $stationData = $station->getValue();

            $slot = null;
            foreach($slotData as $slotKey => $batterySlot)
            {
                if(strpos($slotKey, 'Slot') !== false && $batterySlot === 'Ready')
                {
                    $slot = $slotKey;
                    break;
                }
            }

            // dd($slot);
            if($slot)
            {
                $slotStation->getChild($slot)->set('Booked');
                $bookingCode = strtoupper(Str::random(7));
                // dd($slotStation);
                $transactionRef = $database->getReference('transactions')->push();
                $transactionRef->set([
                    'bookingCode' => $bookingCode,
                    'slot' => $slot,
                    'station' => $station->getChild('name')->getValue(),
                    'transaction_time' => now()->toDateString(),
                    'price' => 20000,
                    'status' => 'UNPAID',
                    'user_id' => $uid,
                    'displayName' => $user->displayName
                ]);

                return redirect()->route('transaction.detail', ['id' => $transactionRef->getKey()]);
            }

            return view('transaction.fail');

        }
    }

    public function process2($id)
    {
        $uid = Session::get('uid');
        $user = app('firebase.auth')->getUser($uid);

        if($user)
        {
            $database = app('firebase.database');
            $slotStation = $database->getReference('SPBKLU');
            $slotData = $slotStation->getValue();
            $station = $database->getReference('Station/'.$id);
            $stationData = $station->getValue();

            $slot = null;
            foreach($slotData as $slotKey => $batterySlot)
            {
                // dd($batterySlot);
                if(strpos($slotKey, 'Slot') !== false && $batterySlot['Booked Status'] === 'Ready')
                {
                    $slot = $slotKey;
                    break;
                }

                // dd($slot);

            }
            // dd($slot);
            if($slot)
            {
                $slotStation->getChild($slot)->update([
                    'Booked Status' => 'Booked'
                ]);

                $transactionRef = $database->getReference('transactions')->push();
                $transactionRef->set([
                    'bookingCode' => random_bytes(6),
                    'slot' => $slot,
                    'station' => $station->getChild('name')->getValue(),
                    'transaction_time' => now()->toDateTimeString(),
                    'price' => 20000,
                    'status' => 'unpaid',
                    'user_id' => $uid
                ]);

                // dd($transactionRef);
                $cancelTime = now()->addMinute(30);
                $transactionId = $transactionRef->getKey();

                $this->scheduleTransactionCancellation($transactionId, $cancelTime);

                return redirect()->route('transaction.detail', ['id' => $transactionRef->getKey()]);
            }

            return view('transaction.fail');
        }
    }


    private function scheduleTransactionCancellation($transactionId, $cancelTime)
    {
        $cancelTask = new \stdClass();
        $cancelTask->transactionId = $transactionId;

        $cancelTaskJson = json_encode($cancelTask);
        $cancelTaskEncoded = base64_encode($cancelTaskJson);

        $cancelUrl = route('transaction.cancel', ['task' => $cancelTaskEncoded]);

        $scheduleCancelScript = "curl --request GET '{$cancelUrl}'";

        $scheduleCommand = "echo '{$scheduleCancelScript}' | at '{$cancelTime->toDateTimeString()}'";

        shell_exec($scheduleCommand);
    }


    
    public function detail($id)
    {
        $database = app('firebase.database');
        $transactionRef = $database->getReference('transactions/'.$id);
        // dd($transactionRef['id']);
        $transactionData = $transactionRef->getValue();
        // dd($transactionData);
        if($transactionData)
        {
            $auth = app('firebase.auth');
            $user = $auth->getUser($transactionData['user_id']);

            $username = $user->displayName;

            return view('transaction.detail', compact('transactionData', 'username', 'id'))->with('title');

        }
        return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
        // dd($transactionRef);
    }

    public function checkout()
    {
        
    }

    public function success($id)
    {
        $database = app('firebase.database');
        $auth = app('firebase.auth');
        $transactionRef = $database->getReference('transactions/'.$id);
        $transactionData = $transactionRef->getValue();
        $user = $auth->getUser($transactionData['user_id']);
        // dd($user);
        // $transactionData = $transactionRef->getValue();

        $transactionRef->update([
            'status' => 'PENDING'
        ]);

        // dd($transactionData['user_id']);
        //config midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        //buat array
        $midtrans_params = [
            'transaction_details' => [
                'order_id' => 'MIDTRANS-' . $transactionData['bookingCode'],
                'gross_amount' => (int) $transactionData['price']
            ],
            'customer_details' => [
                'first_name' => $user->displayName,
                'email' => $user->email,
                'phone' => $user->phoneNumber
            ],
            'enabled_payments' => ['gopay'],
            'gopay' =>  [
                "enable_callback" => true,
                "callback_url" => "http://gopay.com"
            ],
            'vtweb' => []
        ];

        try {
            //ambil halaman payment midtrans
            $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;
            //redirect ke halaman midtrans
            header('location: '.$paymentUrl);
            exit();
        } catch (DatabaseException $e) {
            //throw $th;
            echo $e->getMessage();
        }
        // dd($updatedData);

    }

    public function cancel($id)
    {
        $database = app('firebase.database');
        $transaction = $database->getReference('transactions/'.$id);
        $transactionData = $transaction->getValue();
        $slot = $transactionData['slot'];

        $slotStation = $database->getReference('Booked Status');
        $slotStation->getChild($slot)->set('Available');

        //batalkan transaksi
        $transaction->remove();

        return redirect()->route('transaction.history')->with('success', 'Berhasil hapus transaksi');

    }

    public function history()
    {
        $uid = Session::get('uid');
        $user = app('firebase.auth')->getUser($uid);

        $database = app('firebase.database');
        $transactionRef = $database->getReference('transactions');
        // dd($transactionRef->getKey());
        $historyData = $transactionRef->orderByChild('user_id')->equalTo($user->uid)->getValue();

        $activeData = [];
        $doneData = [];
        foreach($historyData as $key => $transaction)
        {
            if($transaction['status'] === 'UNPAID' || $transaction['status'] === 'PENDING' ){
                $activeData[$key] = $transaction;
            } elseif($transaction['status'] === 'SUCCESS' || $transaction['status'] === 'DONE') {
                $doneData[$key] = $transaction;
            }
        }
        // dd($historyData);
        return view('transaction.history', [
            'activeData' => $activeData,
            'doneData' => $doneData
        ])->with('title', 'History');
    }
}

