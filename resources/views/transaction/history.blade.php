@extends('layouts.template')
@section('content')
@section('breadcrumb')
@include('layouts.breadcrumb')
@endsection
<div class="flex flex-col p-2 space-y-2">
    <h1 class="font-semibold text-center text-lg">{{ $title }}</h1>
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <li class="mr-2 grow" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Aktif</button>
            </li>
            <li class="mr-2 grow" role="presentation">
                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Selesai</button>
            </li>
        </ul>
    </div>
    <div id="myTabContent">
        <div id="profile" role="tabpanel" aria-labelledby="profile-tab" class="hidden p-2 rounded-lg dark:bg-gray-800">
            @forelse($activeData as $key => $data)
                <a href="{{ route('transaction.detail', ['id' => $key]) }}" class="bg-white border-2 space-y-2 rounded-lg p-2 block">
                    <div class="flex justify-between">
                        <div>
                            <h1 class="font-semibold text-gray-800">{{ $data['station'] }}</h1>
                            <p>{{ $data['slot'] }}</p>
                        </div>
                        <div>
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">{{ $data['status'] }}</span>

                        </div>
                    </div>
                    <div class="border-t">
                        <div class="flex justify-between">
                            <h1>Price</h1>
                            <p>{{ $data['price'] }}</p>
                        </div>
                    </div>
                </a>
            @empty
            <div class="bg-white border-2 rounded-lg p-2">
                <p>Tidak ada data</p>
            </div>
            @endforelse
        </div>
        <div id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab" class="hidden p-2 rounded-lg dark:bg-gray-800">
            @forelse($doneData as $key => $data)
                <a href="{{ route('transaction.detail', ['id' => $key]) }}" class="bg-white border-2 space-y-2 rounded-lg p-2 block">
                    <div class="flex justify-between">
                        <div>
                            <h1 class="font-semibold text-gray-800">{{ $data['station'] }}</h1>
                            <p>{{ $data['slot'] }}</p>
                        </div>
                        <div>
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">{{ $data['status'] }}</span>

                        </div>
                    </div>
                    <div class="border-t">
                        <div class="flex justify-between">
                            <h1>Price</h1>
                            <p>{{ $data['price'] }}</p>
                        </div>
                    </div>
                </a>
            @empty
            <div class="bg-white border-2 rounded-lg p-2">
                <p>Tidak ada data</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection