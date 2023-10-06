@extends('layouts.guest')
@section('content')
<div class="overflow-hidden">
    <iframe id="videoIframe" src="https://www.youtube.com/embed/t6CC_z35hPA?autoplay=1&loop=1&controls=0" allow="autoplay" title="video monitor BSS (battrey swaping station )TELKOM UNIVERSITY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen style="width:100vw; height:100vh"></iframe>
</div>
<!-- <div id="videoIframe"></div> -->
<div class="w-full">
    <div class="my-auto">

        <div id="transactionDetails"></div>
    </div>
</div>
@push('api-script')
<script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
<script>

const videoIframe = document.getElementById('videoIframe');

var pusher = new Pusher('27ac5f4676ab40d1f6a0', {
    cluster: 'ap1'
});

var channel = pusher.subscribe('booking-monitor');

channel.bind('booking-monitor', function(data){
    // alert(JSON.stringify(data.transactionData.station));

    const transactionDetails = document.getElementById('transactionDetails');

    let html = `
    <form action="monitor/guide/1/${data.key}" method="POST" id="bookingForm">
        @csrf
        <div class="space-y-2 flex flex-col justify-center">
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
        </div>
    </form>`;

    transactionDetails.innerHTML = html;
    transactionDetails.style.display = "block";
    videoIframe.style.display = "none";
    
});


channel.bind('pusher:subscription_error', function(data) {
    console.log(data);
    alert("not success")
});

</script>
@endpush
@endsection