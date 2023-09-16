@extends('layouts.template')
@section('content')
@section('breadcrumb')
@include('layouts.breadcrumb')
@endsection
<form action="{{ route('profile.update', $user->uid) }}" method="POST" class="p-2 space-y-2" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h1 class="text-lg font-semibold">Change Profile</h1>
    
    <div class="inline-flex space-x-2 items-center">
        <div class="bg-gray-100 w-12 p-2 rounded-full">
            <div>
                @if($user->photoUrl)
                    <img src="{{ $user->photoUrl }}" class="rounded-full w-12" alt="">
                @else
                    <img src="{{ asset('storage/image/animasi.png') }}" class="w-auto" alt="">
                @endif
            </div>
            
        </div>
        <div>
            <input type="file" name="photo" class="w-auto rounded">
            @error('photo')
                <span class="w-full bg-red-100 text-red-700" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="bg-white p-2 rounded-lg border shadow">
        <div class="mb-6">
            <label for="displayName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your name</label>
            <input type="text" id="displayName" name="displayName" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="{{ $user->displayName }}" value="{{ $user->displayName }}" required>
            @error('displayName')
                <span class="w-full bg-red-100 text-red-700" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="phoneNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your phone</label>
            <input type="number" id="phoneNumber" name="phoneNumber" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="{{ $user->phoneNumber }}" value="{{ $user->phoneNumber }}">
            @error('phoneNumber')
            <span class="w-full bg-red-200 text-red-700" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
            <input type="email" id="email" name="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Masukkan email" value="{{ $user->email }}" readonly>
            @error('email')
            <span class="w-full bg-red-200 text-red-700" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <button type="submit" class="w-full bg-green-500 p-2 text-white rounded-lg">Save</button>
    </div>
</form>
<form action="{{ route('profile.password', $user->uid) }}" method="POST" class="p-2 space-y-2">
    @csrf
    @method('PATCH')
    <h1 class="text-base font-medium">Change Password</h1>
    <div class="bg-white rounded-lg border p-2 space-y-2 shadow">
        <div class="mb-6">
            <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your new password</label>
            <input type="password" id="new_password" name="new_password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Masukkan password">
            @error('new_password')
            <span class="w-full bg-red-200 text-red-700" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="new_confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
            <input type="password" id="new_confirm_password" name="new_confirm_password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Konfirmasi password">
            @error('new_confirm_password')
            <span class="w-full bg-red-200 text-red-700" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="w-full p-2 bg-green-500 text-white rounded-lg">Save</button>
    </div>
</form>
@endsection