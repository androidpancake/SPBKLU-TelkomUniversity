@extends('layouts.template')
@section('content')
<div class="flex flex-col space-y-2 overflow-y-auto h-full">
    @foreach($stationData as $data)
    <a href="{{ route('station.detail', ['key' => $data['key']]) }}">
        <div class="rounded-lg bg-white shadow border border-gray-200">
            <img src="{{ $data['image'] }}" class="rounded-t-lg" alt="">
            <div class="flex flex-col items-start w-full">
                <div class="w-full p-2">
                    <h1 class="font-semibold text-lg flex-nowrap">{{ $data['name'] }}</h1>
                    <div>
                        <p class="text-sm text-gray-500">Ketersediaan</p>
                    </div>
                    <p class="text-sm font-semibold inline space-x-1">{{ $data['slotCount'] }}{{ $data['slotTotal'] }} slot</p>
                </div>
                <a href="{{ $data['location'] }}" class="pl-2">
                    <div class="inline-flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 256 256"><path d="M229.66,109.66l-48,48A8,8,0,0,1,168,152V112H128a88.1,88.1,0,0,0-88,88,8,8,0,0,1-16,0A104.11,104.11,0,0,1,128,96h40V56a8,8,0,0,1,13.66-5.66l48,48A8,8,0,0,1,229.66,109.66Z"></path></svg>
                    <p class="text-green-600 font-semibold">Direction</p>
                    </div>
                </a>
            </div>
        </div>
    </a>
    @endforeach
</div>
@endsection