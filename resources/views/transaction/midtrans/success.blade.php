@extends('layouts.template')
@section('content')

@section('breadcrumb')

@endsection

<div class="bg-white flex flex-col space-y-4 items-center justify-between h-full p-2">
    <div></div>
    <div class="space-y-2">
        <h1 class="text-center text-2xl font-semibold">Transaksi sukses</h1>
        <p class="text-sm text-center">Yey transaksi anda berhasil</p>
    </div>
    <div class="flex flex-col w-full space-y-2">
        <a href="{{ route('booking.index') }}" class="bg-green-500 px-3 py-2.5 w-full rounded-lg text-white text-center font-medium">Ke halaman booking</a>
        <a href="" class="text-gray-800 px-3 py-2.5 w-full rounded-lg text-center">Ke halaman utama</a> 
    </div>
</div>
@endsection