@extends('layouts.template')
@section('content')
@section('breadcrumb')
@include('layouts.breadcrumb')
@endsection
<div class="flex flex-col bg-gray-50 h-full">
    <div class="flex justify-center items-center mt-4">
        <div class="bg-white border border-gray-500 rounded grid grid-cols-2 gap-4 p-4 w-64 justify-center items-center">
            @if($selectedSlot == 'Slot 1')
            <div class="border-2 border-green-500 rounded bg-white p-6 w-full h-24 flex" id="slot1">
                <div class="flex justify-center items-center w-full">Slot 1</div>
            </div>
            @else
            <div class="border border-gray-500 rounded bg-white p-6 w-full h-24" id="slot1"></div>
            @endif
            @if($selectedSlot == 'Slot 2')
            <div class="border-2 border-green-500 rounded bg-white p-6 w-full h-24 flex" id="slot2">
                <div class="flex justify-center items-center w-full">Slot 2</div>
            </div>
            @else
            <div class="border border-gray-500 rounded bg-white p-6 w-full h-24" id="slot2"></div>
            @endif
            @if($selectedSlot == 'Slot 3')
            <div class="border-2 border-green-500 rounded bg-white p-6 w-full h-24 flex" id="slot3">
                <div class="flex justify-center items-center w-full">Slot 3</div>
            </div>
            @else
            <div class="border border-gray-500 rounded bg-white p-6 w-full h-24" id="slot3"></div>
            @endif
            @if($selectedSlot == 'Slot 4')
            <div class="border-2 border-green-500 rounded bg-white p-6 w-full h-24 flex" id="slot4">
                <div class="flex justify-center items-center w-full">Slot 4</div>
            </div>
            @else
            <div class="border border-gray-500 rounded bg-white p-6 w-full h-24" id="slot4"></div>
            @endif
        </div>
    </div>
    
    <form action="{{ route('booking.guide2', $id) }}" method="POST" class="h-full">
        @csrf
        <div class="flex flex-col justify-between space-y-2 w-full h-full p-3">
            <div class="flex flex-col bg-white border border-gray-300 rounded-lg p-4">
                <h1 class="font-bold text-center text-lg">Tata cara pengambilan</h1>
                <ul class="list-disc list-inside">
                    <ol class="mt-2 space-y-1 list-decimal list-inside">
                        <li>Tekan tombol pada pintu cabin yang kosong</li>
                        <li class="whitespace-normal">Masukan baterai yang akan ditukar pada 
                            <p class="font-medium">{{ $selectedSlot }}</p>
                            lalu tutup kembali pintu kabin</li>
                        <li>Tekan tombol pada pintu cabin yang terdapat baterai siap pakai.</li>
                        <li>Tutup kembali pintu kabin</li>
                    </ol>
                </ul>
            </div>
            <button type="submit" class="px-2.5 py-3 w-full rounded-lg text-white bg-green-500 hover:bg-green-600 font-medium">Lanjut</button>
        </div>
    </form>
    
</div>
@endsection