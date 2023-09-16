@extends('layouts.template')
@section('content')

@section('breadcrumb')
@include('layouts.breadcrumb')
@endsection

<div class="flex flex-col space-y-2 overflow-y-auto h-full p-2">
    @foreach($data as $data => $station)
    <a href="{{ route('station.detail', $data) }}" class="block">
        <div class="rounded-lg bg-white shadow border border-gray-200">
            <img src="{{ $station['image'] }}" class="rounded-t-lg" alt="">
            <div class="flex flex-row justify-between items-center w-full px-2 py-2.5">
                <div class="w-full">
                    <p class="text-gray-500 text-sm">station</p>
                    <h1 class="font-semibold text-lg flex-nowrap">{{ $station['name'] }}</h1>
                    <!-- <div>
                        <p class="text-sm text-gray-500">Ketersediaan</p>
                    </div> -->
                    <div class="inline-flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-800" fill="currentColor" viewBox="0 0 256 256"><path d="M200,40H56A16,16,0,0,0,40,56V200a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V56A16,16,0,0,0,200,40Zm0,80H136V56h64ZM120,56v64H56V56ZM56,136h64v64H56Zm144,64H136V136h64v64Z"></path></svg>
                        <p class="text-sm font-semibold">{{ $slotCount }} dari {{ $slotTotal }} slot</p>
                    </div>
                </div>
                <a href="{{ $station['direction'] }}">
                    <div class="inline-flex space-x-2 rounded-full p-2 border">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 256 256"><path d="M232.49,112.49l-48,48a12,12,0,0,1-17-17L195,116H128a84.09,84.09,0,0,0-84,84,12,12,0,0,1-24,0A108.12,108.12,0,0,1,128,92h67L167.51,64.48a12,12,0,0,1,17-17l48,48A12,12,0,0,1,232.49,112.49Z"></path></svg>                    
                    </div>
                </a>
            </div>
        </div>
    </a>
    @endforeach
</div>
@endsection