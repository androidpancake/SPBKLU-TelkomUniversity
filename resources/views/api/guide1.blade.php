@extends('layouts.guest')
@section('content')
<div class="flex flex-col bg-gray-50 h-screen">
    <div id="detailBooking"></div>
    
</div>
@push('detail-api')
<script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>

<script type="text/javascript">
    const videoIframe = document.getElementById('detailBooking');

    var pusher = new Pusher('27ac5f4676ab40d1f6a0', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('booking-detail');

    channel.bind('booking-detail', function(data){
        console.log(data);

        const detailBooking = document.getElementById('detailBooking');

        let html = `<img src="{{ asset('storage/image/bg-telu.png') }}" class="h-auto" alt="">
            <div class="flex flex-col space-y-2 w-full p-3">
                <div class="flex justify-center items-center mt-4">
                    <div class="bg-white border border-gray-500 rounded grid grid-cols-2 gap-4 p-4 w-64 justify-center items-center">
                        @if(${data.selectedSlot} == 'Slot 1')
                        <div class="border-2 border-green-500 rounded bg-white p-6 w-full h-24 flex" id="slot1">
                            <div class="flex justify-center items-center w-full">Slot 1</div>
                        </div>
                        @else
                        <div class="border border-gray-500 rounded bg-white p-6 w-full h-24" id="slot1"></div>
                        @endif
                        @if(${data.selectedSlot} == 'Slot 2')
                        <div class="border-2 border-green-500 rounded bg-white p-6 w-full h-24 flex" id="slot2">
                            <div class="flex justify-center items-center w-full">Slot 2</div>
                        </div>
                        @else
                        <div class="border border-gray-500 rounded bg-white p-6 w-full h-24" id="slot2"></div>
                        @endif
                        @if(${data.selectedSlot} == 'Slot 3')
                        <div class="border-2 border-green-500 rounded bg-white p-6 w-full h-24 flex" id="slot3">
                            <div class="flex justify-center items-center w-full">Slot 3</div>
                        </div>
                        @else
                        <div class="border border-gray-500 rounded bg-white p-6 w-full h-24" id="slot3"></div>
                        @endif
                        @if(${data.selectedSlot} == 'Slot 4')
                        <div class="border-2 border-green-500 rounded bg-white p-6 w-full h-24 flex" id="slot4">
                            <div class="flex justify-center items-center w-full">Slot 4</div>
                        </div>
                        @else
                        <div class="border border-gray-500 rounded bg-white p-6 w-full h-24" id="slot4"></div>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col bg-white border-2 rounded-lg p-4 h-full">
                    <h1 class="font-bold text-center text-lg">Tata cara pengambilan</h1>
                    <ul class="list-disc list-inside">
                        <ol class="mt-2 space-y-1 list-decimal list-inside">
                            <li>Tekan tombol pada pintu cabin yang kosong</li>
                            <li class="whitespace-normal">Masukan baterai yang akan ditukar pada 
                                <p class="font-medium">{{ ${data.selectedSlot} }}</p>
                                lalu tutup kembali pintu kabin</li>
                            <li>Tekan tombol pada pintu cabin yang terdapat baterai siap pakai.</li>
                            <li>Tutup kembali pintu kabin</li>
                        </ol>
                    </ul>
                </div>
                <button type="submit" class="px-2.5 py-3 w-full rounded-lg text-white bg-green-400 hover:bg-green-600 font-medium">Lanjut</button>
            </div>`
    detailBooking.innerHTML = html;
    });

    

</script>
@endpush
@endsection