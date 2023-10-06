@extends('layouts.template')
@section('content')
@section('breadcrumb')
@include('layouts.breadcrumb')
@endsection
<div class="bg-gray-100 p-2 h-full">
    <form action="{{ route('booking.guide1', $id) }}" method="POST" class="flex flex-col justify-between h-full">
        @csrf
        <div class="bg-white border border-gray-300 rounded w-full px-3 py-2 space-y-3">
            <div class="space-y-3">
                <h1 class="text-center font-bold">Status pemesanan</h1>
                <div class="flex justify-between">
                    <p class="text-base text-gray-500">Nama</p>
                    <p class="font-semibold">{{ $user->displayName }}</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-base text-gray-500">Key</p>
                    <p class="font-semibold">{{ $id }}</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-base text-gray-500">Stasiun</p>
                    <p class="font-semibold">{{ $bookingData['station'] }}</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-base text-gray-500">Slot</p>
                    <p class="font-semibold">{{ $bookingData['slot'] }}</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-base text-gray-500 nowrap">Tanggal transaksi</p>
                    <p class="font-semibold">{{ $bookingData['transaction_time'] }}</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-base text-gray-500">Status pembayaran</p>
                    <p class="font-semibold">{{ $bookingData['status'] }}</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-base text-gray-500">Kode booking</p>
                    <p class="font-semibold">{{ $bookingData['bookingCode'] }}</p>
                </div>
            </div>
        </div>
        <div>
            <button type="submit" class="bg-green-500 px-2 py-2.5 rounded font-semibold text-center w-full text-white">Confirm</button>
        </div>
    </form>
</div>
@endsection