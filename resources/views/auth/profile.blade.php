@extends('layouts.template')

@section('content')

<div class="h-full">
  @if(Session::has('message'))
    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
      <span class="font-medium">Info alert!</span>{{ Session::get('message') }}
    </div>
  @endif

  @if ($errors->any())
      @foreach ($errors->all() as $error)
        <div id="alert-2" class="flex p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
          <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
          <span class="sr-only">Info</span>
          <div class="ml-3 text-sm font-medium">
            {{ $error }}
          </div>
          <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
          </button>
        </div>
      @endforeach
  @endif

  @if(Session::has('error'))
    <div id="alert-2" class="flex p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
      <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
      <span class="sr-only">Info</span>
      <div class="ml-3 text-sm font-medium">
        {{ Session::get('error') }}
      </div>
      <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
      </button>
    </div>
  @endif
  
  <div class="flex flex-col justify-center">
    <div class="w-full">
      <h4>Profile Information</code></h5>
        <span class="text-center mb-3">Update your account's profile information and email address.<br><br> When You change your email ,you need to verify your email else the account will be blocked</span>
      </div>

      <div class="w-full text-start">
        <div class="p-2 mb-5 mt-md-3 bg-white border-2 rounded">

          {!! Form::model($user, ['method'=>'PATCH', 'action'=> ['App\Http\Controllers\Auth\ProfileController@update',$user->uid]]) !!}
          {!! Form::open() !!}

          <div>
            {!! Form::label('displayName', 'Name ',['class'=>'text-sm']) !!}
            {!! Form::text('displayName', null, ['class'=>'w-full bg-slate-300 rounded border'])!!}
            
            <label for="phoneNumber">Your Phone</label>
            <input type="number" name="phoneNumber" class="w-full bg-slate-300 rounded border" placeholder="{{ $user->phoneNumber }}">
            {!! Form::label('email', 'Email ',['class'=>'text-sm']) !!}
            {!! Form::email('email', null, ['class'=>'w-full bg-slate-300 rounded border'])!!}

          </div>

          <div class="w-full mt-2 mr-4">
            <div class="text-right">
              <button type="submit" class="w-full bg-green-600 px-2 py-2.5 rounded text-white">Submit</button>
            </div>
          </div>

        </div>
      </div>

    </div>
    <div class="border-bottom border-grey"></div>

    <div class="flex flex-col justify-center pt-5">
      <div class="col-lg-4">
        <h4>Update Password</code></h5>
          <span class="text-justify" style="padding-top:-3px;">Ensure your account is using a long, random password to stay secure.</span>
        </div>

        <div class="pt-0">
          <div class="space-y-2 py-4 bg-white rounded border shadow">

            <div class="form-group px-3">
              <label for="password">Password</label>
              <input type="password" name="new_password" id="password" class="w-full bg-slate-300 border rounded">
            </div>

            <div class="form-group px-3">
              <label for="new_confirm_password">New password</label>
              <input type="password" id="new_confirm_password" name="new_confirm_password" class="w-full bg-slate-300 border rounded">
            </div>

            <div class="pt-3 px-3">
              <div class="">
                <!-- <button type="submit" class="w-full bg-green-600 px-2 py-2.5 rounded text-white">Submit</button> -->

                {!! Form::submit('Save', ['class'=>'w-full bg-green-600 px-2 py-2.5 rounded text-white']) !!}
              </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>

      </div>

      <div class="border-bottom border-grey"></div>

      <div class="flex flex-col justify-center pt-5">
        <div class="items-start">
          <h4>Delete Account</code></h5>
            <span class="text-start">Permanently delete your account.</span>
          </div>

          <div class="col-lg-8 pt-0">
            <div class="shadow py-4 mb-5 mt-md-3 bg-white rounded">
              <div class="text-left px-3">
                Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
              </div>

              {!! Form::open(['method'=>'DELETE', 'action' =>['App\Http\Controllers\Auth\ProfileController@destroy',$user->uid]]) !!}
              {!! Form::open() !!}
              <div class="p-3">
                <div>
                  {!! Form::submit('Delete Account', ['class'=>'bg-red-300 text-red-200 p-3 rounded w-full']) !!}
                </div>
              </div>
              {!! Form::close() !!}
            </div>
          </div>

        </div>

      </div>

    @endsection
