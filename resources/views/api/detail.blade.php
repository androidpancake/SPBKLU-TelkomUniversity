@extends('layouts.template')
@section('content')

<div class="bg-white h-screen p-2 flex items-center">
    <div> 
        <img src="{{ asset('storage/image/bg-telu.png') }}" alt="">
    </div>
    <div id="transactionDetails"></div>
</div>
@push('api-script')
<script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
<script>
// import Echo from 'laravel-echo'
// window.addEventListener('echo-ready', function(){
//     Echo.channel('booking-monitor')
//     .listen('BookingCodeProcessed', (e)=>{
//         console.log("event accepted", e);
//         displayTransactionData(e.transactionData);
//     });
// });

// Pusher.logToConsole = false;

var pusher = new Pusher('27ac5f4676ab40d1f6a0', {
    cluster: 'ap1'
});

var channel = pusher.subscribe('booking-monitor');

channel.bind('App\\Events\\BookingCodePressed', function(data){
    console.log(data.transactionData);  //GK JLN
});

channel.bind('pusher:subscription_succeeded', function(members) {
    alert('successfully subscribed!');
});

channel.bind('pusher:subscription_error', function(data) {
    console.log(data);
    alert("not success")
});

function displayTransactionData(data) {
    const transactionDetails = document.getElementById('transactionDetails');
    
    let html = `
    <form action="/booking/guide1/${data.id}" method="POST" id="bookingForm">
        <input type="hidden" name="_token" value="${csrfToken}">
        <div class="space-y-2 flex flex-col justify-center">
            <div class="flex flex-col bg-white border-2 border-gray-200 rounded w-full px-3 py-2 space-y-3">
                <div class="space-y-3">
                    <h1 class="text-center font-bold">Status Pemesanan</h1>
                    <div class="flex justify-between">
                        <p class="text-base text-gray-500">Nama</p>
                        <p class="font-semibold">${data.user.displayName}</p>
                    </div>
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
                        <p class="font-semibold">${data.transactionData5.bookingCode}</p>
                    </div>
                </div>
            </div>
            <button type="submit" class="bg-green-500 px-2 py-2.5 rounded font-semibold text-center w-full text-white">Confirm</button>
        </div>
    </form>`;

    transactionDetails.innerHTML = html;
}

</script>
@endpush
@endsection