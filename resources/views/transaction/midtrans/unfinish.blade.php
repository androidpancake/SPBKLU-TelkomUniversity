@extends('layouts.template')
@section('content')

@section('breadcrumb')

@endsection

<div class="bg-white flex flex-col space-y-4 items-center justify-between h-full p-2">
    <div></div>
    <div class="space-y-2">
        <h1 class="text-center text-2xl font-semibold">Transaksi gagal</h1>
        <p class="text-sm text-center">Maaf transaksi anda gagal</p>
    </div>
    <div class="flex flex-col w-full space-y-2">
        <a href="{{ route('station.index') }}" class="bg-gray-300 text-gray-800 px-3 py-2.5 w-full rounded-lg text-center">Ke halaman utama</a> 
    </div>
</div>
@endsection