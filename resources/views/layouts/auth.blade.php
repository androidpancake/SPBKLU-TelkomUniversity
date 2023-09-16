<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>SPBKLU</title>
</head>
<body>
    <section class="bg-slate-200 h-auto overflow-auto dark:bg-gray-900">
        <div class="p-2">
            <img src="{{ asset('storage/image/bg.png') }}" class="w-full rounded" alt="header">
        </div>
        <div class="p-2 h-full">
        <div class="flex h-7 w-14 rounded-full bg-gray-100 dark:bg-gray-900"><span class="sr-only">Mode : <span id="darkmode-state">Light</span></span>
          <div class="flex justify-between items-center w-full">
            <div class="flex justify-center items-center h-6 w-6">
              <button class="flex justify-center items-center h-6 w-6 rounded-full bg-yellow-300 text-gray-900 dark:bg-transparent dark:text-gray-200" id="dark-off" type="button">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                  </path>
                </svg><span class="sr-only">Switch to light mode</span>
              </button>
            </div>
            <div class="flex justify-center items-center h-6 w-6">
              <button class="flex justify-center items-center h-6 w-6 rounded-full bg-transparent text-gray-900 dark:bg-white text dark:text-gray-900" id="dark-on" type="button">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                </svg><span class="sr-only">Dark</span>
              </button>
            </div>
          </div>
        </div>
            <div class="mt-4 p-4 bg-white dark:bg-gray-800">
                <div class="h-screen overflow-y-auto">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>