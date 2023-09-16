@extends('layouts.template')
@section('content')

@section('breadcrumb')
@include('layouts.breadcrumb')
@endsection
<div class="w-full">
    <img src="{{ asset('storage/image/checkout.png') }}" class="w-full" alt="">
</div>
<form action="" method="POST">
    <div class="flex flex-col h-auto justify-between p-2">
        <div>
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
            <div class="w-full bg-white rounded-lg border-2 flex justify-between items-center p-2 mt-2">
                <div>
                    <p>Total</p>
                </div>
                <div>
                    <p class="font-semibold text-base">Rp.{{ $transactionData['price'] }},00</p>
                </div>
            </div>
        </div>
        <div class="mt-2">
            <button type="submit" class="w-full px-2 py-2.5 bg-green-600 rounded-full text-white font-semibold">Proses</button>
        </div>
    </div>
</form>


@endsection