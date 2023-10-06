@extends('layouts.guest')
@section('content')
<div class="flex flex-col bg-gray-50 h-screen">
    <img src="{{ asset('storage/image/bg-telu.png') }}" class="h-auto" alt="">
    <form action="{{ route('monitor.done', $id) }}" method="POST">
        @csrf
        <div class="flex flex-col space-y-2 w-full p-3">
            <div class="bg-white p-2 rounded-lg border-2 flex justify-center">
                <div class="inline-flex">
                    <p>Status : </p>
                    <p class="font-semibold">Diambil</p>
                </div>
            </div>
            <div class="flex flex-col bg-white border-2 rounded-lg p-4 h-full">
                <h1 class="font-bold text-center text-lg">Tata cara pengambilan</h1>
                <ul class="list-disc list-inside">
                    <ol class="mt-2 space-y-1 list-decimal list-inside">
                        <li>Tekan tombol pada pintu cabin yang kosong</li>
                        <li class="whitespace-normal">Ambil baterai yang akan ditukar pada 
                            <p class="font-medium">{{ $selectedSlot }}</p>
                            lalu tutup kembali pintu kabin</li>
                        <li>Setelah ditutup silakan klik selesai</li>
                    </ol>
                </ul>
            </div>
            <button type="submit" class="px-2.5 py-3 w-full rounded-lg text-white bg-green-400 hover:bg-green-600 font-medium">Selesai</button>
        </div>
    </form>
    
</div>
@endsection