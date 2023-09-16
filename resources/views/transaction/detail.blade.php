@extends('layouts.template')
@section('content')

@section('breadcrumb')
@include('layouts.breadcrumb')
@endsection
<div class="w-full">
    <img src="{{ asset('storage/image/checkout.png') }}" class="w-full" alt="">
</div>
<form action="{{ route('transaction.success', $id) }}" method="POST">
    @csrf
    <div class="flex flex-col h-full justify-between space-y-2 p-2">
        <div class="space-y-1">
            <p class="text-center">Booking Code : {{ $transactionData['bookingCode'] }}</p>
            <div class="w-full bg-white rounded-lg border-2 flex justify-between p-2">
                <div>
                    <p class="text-sm text-gray-600">Nama pembeli</p>
                    <p class="font-semibold text-base">{{ $username }}</p>
                </div>
                <div class="flex flex-col justify-end">
                    <p class="text-sm text-gray-600">Station</p>
                    <p class="font-semibold text-base">{{ $transactionData['station'] }}</p>
                </div>
            </div>
            <div class="w-full bg-white rounded-lg border-2 flex justify-between items-center p-2 ">
                <div>
                    <p>Slot</p>
                </div>
                <div>
                    <p class="font-semibold text-base">{{ $transactionData['slot'] }}</p>
                </div>
            </div>
            <div class="w-full bg-white rounded-lg border-2 flex justify-between items-center p-2">
                <div>
                    <p>Total</p>
                </div>
                <div>
                    <p class="font-semibold text-base">Rp.{{ $transactionData['price'] }},00</p>
                </div>
            </div>
            @if($transactionData['status'] != 'SUCCESS' && $transactionData['status'] != 'DONE')
            <div class="w-full bg-blue-200 rounded-lg items-center p-2">
                <h1 class="font-medium text-sm">Information</h1>
                <p class="text-xs">Segera lakukan pembayaran atau transaksi akan dibatalkan otomatis</p>
            </div>
        </div>
        <div>
            <button type="submit" class="px-2 py-2.5 w-full bg-green-600 rounded-lg text-white font-medium">Bayar</button>
        </div>
        @endif
    </div>
    
</form>

@if($transactionData['status'] =! 'SUCCESS')
<form action="{{ route('transaction.cancel', $id) }}" method="POST" class="p-2 text-center">
    @csrf
    @method('DELETE')
    <button type="submit" class="bg-transparent text-red-400">Batalkan transaksi</button>
</form>
@endif

@endsection