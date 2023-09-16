@extends('layouts.template')
@section('content')

@section('breadcrumb')

@include('layouts.breadcrumb')

@endsection
<div class="flex flex-col justify-between h-full p-2">
    <div>
        <div class="flex justify-between items-start">
            <div class="inline-flex">
                <img src="{{ asset('storage/image/animasi.png') }}" class="w-12 h-12 rounded-full" alt="">
                <div>
                    <h1 class="font-semibold text-lg">{{ $user->displayName }}</h1>
                    <p class="text-sm">{{ $user->phoneNumber }}</p>
                    <p class="text-sm">{{ $user->email }}</p>
                </div>
            </div>
            <div>
                <a href="{{ route('profile.edit', $user->uid) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 256 256"><path d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM192,108.68,147.31,64l24-24L216,84.68Z"></path></svg>
                </a>
            </div>
        </div>
        <div class="mt-4">
            <h1 class="font-medium text-sm text-gray-800">Information</h1>
            <div class="divide-y divide-gray-400">
                <a href="{{ route('terms') }}" class="flex justify-between items-center py-3">
                    <!-- icon -->

                    <!-- name -->
                    <p class="text-base font-semibold text-gray-800">Ketentuan Pengembalian Dana</p>

                    <!-- icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 256 256"><path d="M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z"></path></svg>
                </a>
                <div class="flex justify-between items-center py-3">
                    <!-- icon -->

                    <!-- name -->
                    <p class="text-base font-semibold text-gray-800">About us</p>

                    <!-- icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 256 256"><path d="M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z"></path></svg>
                </div>
                <div class="flex justify-between items-center py-3">
                    <!-- icon -->

                    <!-- name -->
                    <p class="text-base font-semibold text-gray-800">Pusat bantuan</p>

                    <!-- icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 256 256"><path d="M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z"></path></svg>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="bg-red-100 text-red-600 px-2 py-2.5 w-full rounded-lg font-medium">Logout</button>
    </form>
</div>
@endsection