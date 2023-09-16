<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use App\Mail\TransactionSuccess;
use Illuminate\Support\Facades\Mail;

class MidtransController extends Controller
{
    public function notificationHandler(Request $request)
    {
        //transaksi
        $database = app('firebase.database');
        $auth = app('firebase.auth');

        //set konfigurasi
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        //buat instance notification
        $notification = new Notification();
        
        //test
        $order = explode('-', $notification->order_id);
        // dd($order);
        //assign variable
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $order[1];

        //cari transaksi berdasarkan id
        $transactionRef = $database->getReference('transactions');
        $transactions = $transactionRef->getValue();
        
        $targetTransaction = null;
        $targetTransactionId = null;
        foreach($transactions as $id => $transaction)
        {
            if(isset($transaction['bookingCode']) && $transaction['bookingCode'] == $order_id)
            {
                $targetTransactionId = $id;
                $targetTransaction = $transaction;
                break;
            }
        }
        $user = $transaction['user_id'];
        if($status == 'capture'){
            if($type == 'credit_card')
            {
                if($fraud == 'challenge')
                {
                    $transaction['status'] = 'CHALLENGE'; 
                } else {
                    $transaction['status'] = 'SUCCESS';
                }
            }
        } elseif($status == 'settlement') {
            $transaction['status'] = 'SUCCESS';
        } elseif($status == 'pending') {
            $transaction['status'] = 'PENDING';
        } elseif($status == 'deny') {
            $transaction['status'] = 'FAILED';
            $database->getReference('Booked Status/'.$transaction['slot'])->set('Ready');
        } elseif($status == 'expire') {
            $transaction['status'] = 'EXPIRED';
            $database->getReference('Booked Status/'.$transaction['slot'])->set('Ready');
        } elseif($status == 'cancel') {
            $transaction['status'] = 'FAILED';
            $database->getReference('Booked Status/'.$transaction['slot'])->set('Ready');
        }
        
        $transactionRef->getChild($targetTransactionId)->update($targetTransaction);
        
        if($transaction)
        {
            if($status == 'capture' && $fraud == 'challenge')
            {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Challenge'
                    ]
                ]);
            }
            elseif($status == 'settlement' && $fraud == 'accept')
            {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Success'
                    ]
                ]);
            }
            else {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans payment not settlement'
                    ]
                ]);
            }
            
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans payment success'
                ]
            ]); 
        }
        
    }

    public function finish(Request $request)
    {
        return view('transaction.midtrans.success');
    }
    
    public function unfinishRedirect(Request $request)
    {
        return view('transaction.midtrans.unfinish');
    }
    
    public function error(Request $request)
    {
        return view('transaction.midtrans.error');
    }
}
