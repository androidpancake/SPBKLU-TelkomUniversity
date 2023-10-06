@extends('layouts.guest')
@section('content')
<div class="overflow-hidden">
    <iframe id="videoIframe" src="https://www.youtube.com/embed/t6CC_z35hPA?autoplay=1&loop=1&controls=0" allow="autoplay" title="video monitor BSS (battrey swaping station )TELKOM UNIVERSITY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen style="width:100vw; height:100vh"></iframe>
</div>
<!-- <div id="videoIframe"></div> -->
<div class="w-full">
    <div class="my-auto">
        <div id="transactionDetails"></div>
        <div id="guide1"></div>
        <div id="guide2"></div>
    </div>
</div>
@push('api-script')
<script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
<script>

const videoIframe = document.getElementById('videoIframe');
const transactionDetails = document.getElementById('transactionDetails');
const guide1 = document.getElementById('guide1');

var pusher = new Pusher('27ac5f4676ab40d1f6a0', {
    cluster: 'ap1'
});

var channel = pusher.subscribe('booking-monitor');

channel.bind('booking-monitor', function(data){
    // alert(JSON.stringify(data.transactionData.station));

    const transactionDetails = document.getElementById('transactionDetails');

    let html = `
        <div class="space-y-2 flex flex-col justify-center items-center p-2">
            <div class="flex flex-col bg-white border-2 border-gray-200 rounded w-full px-3 py-2 space-y-3">
                <div class="space-y-3">
                    <h1 class="text-center font-bold">Status Pemesanan</h1>
                    <div class="flex justify-between">
                        <p class="text-base text-gray-500">Stasiun</p>
                        <p class="font-semibold">${data.transactionData.station}</p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-base text-gray-500 nowrap">Tanggal transaksi</p>
                        <p class="font-semibold">${data.transactionData.transaction_time}</p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-base text-gray-500">Status pembayaran</p>
                        <p class="font-semibold">${data.transactionData.status}</p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-base text-gray-500">Kode booking</p>
                        <p class="font-semibold">${data.transactionData.bookingCode}</p>
                    </div>
                </div>
            </div>
        </div>`;

    transactionDetails.innerHTML = html;
    transactionDetails.style.display = "block";
    videoIframe.style.display = "none";
    
});

var channel2 = pusher.subscribe('booking-detail');

channel2.bind('booking-detail', function(data){
    // console.log(data.id);
    const guide1 = document.getElementById('guide1');
    const result = data.selectedSlot;
    let html2 = '<div class="h-screen flex justify-center items-center gap-2">' +
        '<div class="bg-white border border-gray-500 rounded grid grid-cols-2 gap-4 p-4 w-64 justify-center items-center">';
    
    if (result === 'Slot 1') {
        html2 += '<div class="border-2 border-green-500 rounded bg-white p-6 w-full h-24 flex" id="slot1">' +
            '<div class="flex justify-center items-center w-full">Slot 1</div>' +
            '</div>';
    } else {
        html2 += `<div class="border border-gray-500 rounded bg-white p-6 w-full h-24" id="slot1"></div>`;
    }
    if (result === 'Slot 2') {
        html2 += '<div class="border-2 border-green-500 rounded bg-white p-6 w-full h-24 flex" id="slot1">' +
            '<div class="flex justify-center items-center w-full">Slot 2</div>' +
            '</div>';
    } else {
        html2 += `<div class="border border-gray-500 rounded bg-white p-6 w-full h-24" id="slot2"></div>`;
    } if (result === 'Slot 3') {
        html2 += '<div class="border-2 border-green-500 rounded bg-white p-6 w-full h-24 flex" id="slot1">' +
            '<div class="flex justify-center items-center w-full">Slot 3</div>' +
            '</div>';
    } else {
        html2 += `<div class="border border-gray-500 rounded bg-white p-6 w-full h-24" id="slot3"></div>`;
    } if (result === 'Slot 4') {
        html2 += '<div class="border-2 border-green-500 rounded bg-white p-6 w-full h-24 flex" id="slot1">' +
            '<div class="flex justify-center items-center w-full">Slot 4</div>' +
            '</div>';
    } else {
        html2 += `<div class="border border-gray-500 rounded bg-white p-6 w-full h-24" id="slot4"></div>`;
    }
    
    html2 += '</div>';

    html2 += `<div class="flex flex-col bg-white border border-gray-300 rounded-lg p-4">
                <h1 class="font-bold text-center text-lg">Tata cara pengambilan</h1>
                <ul class="list-disc list-inside">
                    <ol class="mt-2 space-y-1 list-decimal list-inside">
                        <li>Tekan tombol pada pintu cabin yang kosong</li>
                        <li class="whitespace-normal">Masukan baterai yang akan ditukar pada 
                            <p class="font-medium">${result}</p>
                            lalu tutup kembali pintu kabin</li>
                        <li>Tekan tombol pada pintu cabin yang terdapat baterai siap pakai.</li>
                        <li>Tutup kembali pintu kabin</li>
                    </ol>
                </ul>
            </div>`;

    html2 += '</div>';

    guide1.innerHTML = html2;
    transactionDetails.style.display = "none";
    videoIframe.style.display = "none";
});

var channel3 = pusher.subscribe('guide-channel');
channel3.bind('guide-channel', function(data){

    const guide2 = document.getElementById('guide2');
    const result = data.slot;

    let html3 = '<div class="h-screen flex justify-center items-center gap-2">' +
        '<div class="bg-white border border-gray-500 rounded grid grid-cols-2 gap-4 p-4 w-64 justify-center items-center">';
    
    if (result === 'Slot 1') {
        html3 += '<div class="border-2 border-green-500 rounded bg-white p-6 w-full h-24 flex" id="slot1">' +
            '<div class="flex justify-center items-center w-full">Slot 1</div>' +
            '</div>';
    } else {
        html3 += `<div class="border border-gray-500 rounded bg-white p-6 w-full h-24" id="slot1"></div>`;
    }
    if (result === 'Slot 2') {
        html3 += '<div class="border-2 border-green-500 rounded bg-white p-6 w-full h-24 flex" id="slot1">' +
            '<div class="flex justify-center items-center w-full">Slot 2</div>' +
            '</div>';
    } else {
        html3 += `<div class="border border-gray-500 rounded bg-white p-6 w-full h-24" id="slot2"></div>`;
    } if (result === 'Slot 3') {
        html3 += '<div class="border-2 border-green-500 rounded bg-white p-6 w-full h-24 flex" id="slot1">' +
            '<div class="flex justify-center items-center w-full">Slot 3</div>' +
            '</div>';
    } else {
        html3 += `<div class="border border-gray-500 rounded bg-white p-6 w-full h-24" id="slot3"></div>`;
    } if (result === 'Slot 4') {
        html3 += '<div class="border-2 border-green-500 rounded bg-white p-6 w-full h-24 flex" id="slot1">' +
            '<div class="flex justify-center items-center w-full">Slot 4</div>' +
            '</div>';
    } else {
        html3 += `<div class="border border-gray-500 rounded bg-white p-6 w-full h-24" id="slot4"></div>`;
    }
    html3 += '</div>';
    html3 += `<div class="flex flex-col bg-white border-2 rounded-lg p-4">
                <h1 class="font-bold text-center text-lg">Tata cara pengambilan</h1>
                <ul class="list-disc list-inside">
                    <ol class="mt-2 space-y-1 list-decimal list-inside">
                        <li>Tekan tombol pada pintu cabin yang kosong</li>
                        <li class="whitespace-normal">Ambil baterai yang akan ditukar pada 
                            <p class="font-medium">${result}</p>
                            lalu tutup kembali pintu kabin</li>
                        <li>Setelah ditutup silakan klik selesai</li>
                    </ol>
                </ul>
            </div>`;

    html3 += '</div>';

    guide2.innerHTML = html3
    guide1.style.display = "none";

});
var channel4 = pusher.subscribe('done');

channel4.bind('done', function(data){
    window.location.href = '/monitor';
});
channel.bind('pusher:subscription_error', function(data) {
    console.log(data);
    alert("not success");
});

</script>
@endpush
@endsection