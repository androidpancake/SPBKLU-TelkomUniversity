@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="flex flex-row justify-center">
        <div class="">
            <div class="bg-white rounded">
                <div class="text-gray-900 text-base font-semibold">Verify Your Email Address</div>

                <div class="bg-white">
                  @if (session('resent'))
                      <!-- <div class="alert alert-success" role="alert">
                          {{ __('A fresh verification link has been sent to your email address.') }}
                      </div> -->
                      <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <span class="font-medium">{{ __('A fresh verification link has been sent to your email address.') }}</span>
                        </div>
                  @endif
                  @if(Session::has('error'))
                    <p class="bg-red-100 p-3 {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
                  @endif

                    Before proceeding, please check your email for a verification link.
                    If you did not receive the email

                    <form class="inline-flex" method="POST" action="{{ route('reset.verify') }}">
                        @csrf
                        <button type="submit" class="bg-blue py-2.5 px-2">{{ __('click here to request another') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
