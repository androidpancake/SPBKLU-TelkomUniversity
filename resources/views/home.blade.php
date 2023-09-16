@extends('layouts.template')

@section('content')
<div class="flex mt-24">
    <img src="{{ asset('storage/image/bg-telu.png')}}" class="w-full rounded" alt="">
</div>
<div class="grid grid-cols-4 bg-white py-2 rounded-lg mt-4">
    <a href="{{ route('station.map') }}" class="flex flex-col items-center space-y-2">
        <div class="bg-green-500 rounded-full items-center p-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 256 256"><path d="M256,96v64a8,8,0,0,1-16,0V96a8,8,0,0,1,16,0ZM224,80v96a24,24,0,0,1-24,24H32A24,24,0,0,1,8,176V80A24,24,0,0,1,32,56H200A24,24,0,0,1,224,80Zm-85.19,43.79A8,8,0,0,0,132,120H112.94l10.22-20.42a8,8,0,1,0-14.32-7.16l-16,32A8,8,0,0,0,100,136h19.06l-10.22,20.42a8,8,0,0,0,14.32,7.16l16-32A8,8,0,0,0,138.81,123.79Z"></path></svg>
        </div>
        <div class="flex flex-wrap">
            <p class="text-sm font-medium">SPBKLU <br> terdekat</p>  
        </div>
    </a>
    <a href="{{ route('station.index') }}" class="flex flex-col items-center space-y-2">
        <div class="bg-green-500 rounded-full items-center p-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 256 256"><path d="M128,16a88.1,88.1,0,0,0-88,88c0,75.3,80,132.17,83.41,134.55a8,8,0,0,0,9.18,0C136,236.17,216,179.3,216,104A88.1,88.1,0,0,0,128,16Zm0,56a32,32,0,1,1-32,32A32,32,0,0,1,128,72Z"></path></svg>        </div>
        <div class="text-center">
            <p class="text-sm font-medium">Lokasi <br> SPBKLU</p>  
        </div>
    </a>
    <a href="{{ route('booking.index') }}" class="flex flex-col items-center space-y-2">
        <div class="bg-green-500 rounded-full items-center p-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 256 256"><path d="M216,40H40A16,16,0,0,0,24,56V208a8,8,0,0,0,11.58,7.15L64,200.94l28.42,14.21a8,8,0,0,0,7.16,0L128,200.94l28.42,14.21a8,8,0,0,0,7.16,0L192,200.94l28.42,14.21A8,8,0,0,0,232,208V56A16,16,0,0,0,216,40ZM176,144H80a8,8,0,0,1,0-16h96a8,8,0,0,1,0,16Zm0-32H80a8,8,0,0,1,0-16h96a8,8,0,0,1,0,16Z"></path></svg>
        </div>
        <div class="text-center">
            <p class="text-sm font-medium">Ambil <br> baterai</p>  
        </div>
    </a>
    <a href="{{ route('transaction.history') }}" class="flex flex-col items-center space-y-2">
        <div class="bg-green-500 rounded-full items-center p-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 256 256"><path d="M224,128A96,96,0,0,1,62.11,197.82a8,8,0,1,1,11-11.64A80,80,0,1,0,71.43,71.43C67.9,75,64.58,78.51,61.35,82L77.66,98.34A8,8,0,0,1,72,112H32a8,8,0,0,1-8-8V64a8,8,0,0,1,13.66-5.66L50,70.7c3.22-3.49,6.54-7,10.06-10.55A96,96,0,0,1,224,128ZM128,72a8,8,0,0,0-8,8v48a8,8,0,0,0,3.88,6.86l40,24a8,8,0,1,0,8.24-13.72L136,123.47V80A8,8,0,0,0,128,72Z"></path></svg>        </div>
        <div class="text-center">
            <p class="text-sm font-medium">History <br> pemesanan</p>  
        </div>
    </a>
</div>
<!-- <div class="bg-white shadow-lg rounded border border-gray-400 p-2">
    <h1 class="text-base text-gray-800 font-semibold">Info</h1>
    <p class="text-gray-700">halo halo</p>
</div> -->
@include('layouts.nav')

@endsection
