@extends('layouts.auth')

@section('content')
<div class="bg-white rounded">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="bg-white rounded border">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                        <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <span class="font-medium">{{ __('A fresh verification link has been sent to your email address.') }}</span>
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="inline-flex" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="bg-blue py-2.5 px-2">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
