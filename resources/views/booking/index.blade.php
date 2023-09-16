@extends('layouts.template')
@section('content')
@section('breadcrumb')
@include('layouts.breadcrumb')
@endsection

<div class="w-full h-full p-2">
    <div class="bg-white border rounded-lg p-2 shadow h-full space-y-8 flex">
        <form action="{{ route('booking.get') }}" method="POST" class="flex flex-col justify-between w-full">
            @csrf
            <div class="space-y-4">
                <img src="{{ asset('storage/image/bg.png') }}" class="w-full" alt="">
                <h1 class="text-center font-bold text-2xl mt-2 text-gray-600">Booking</h1>
                <div>
                    @if(session('error'))
                    <span class="bg-red-100 text-red-800 p-2 flex w-full rounded">{{ session('error') }}</span>
                    @endif
                </div>
                <div class="space-y-1">
                    <label for="booking" class="text-sm text-gray-600">Masukkan kode booking</label>
                    <input type="text" id="booking" name="bookingCode" class="w-full bg-gray-100 rounded-lg border-2 border-gray-300 focus:ring-green-500 focus:border-green-500" placeholder="XXXXXXX">
                </div>
            </div>
            <div>
                <button type="submit" class="w-full bg-green-500 px-3 py-2.5 rounded-lg text-white font-semibold hover:bg-green-700">Submit</button>
            </div>
        </form>
    </div>  
</div>
@endsection