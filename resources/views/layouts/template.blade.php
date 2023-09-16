<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>

@vite(['resources/css/app.css','resources/js/app.js'])
<title>SPBKLU</title>
</head>
<body>
    
<nav class="fixed top-0 right-0 left-0 bg-green-500 border-gray-200 dark:bg-gray-900">
  <div class="max-w-screen-xl flex justify-between items-center p-4">
    <div>
        @yield('breadcrumb')
    </div>
    <div class="flex">
        <a href="{{ url('/') }}">
            <img src="{{ asset('storage/image/judul.png') }}" class="h-8" alt="SPBKLU Logo" />
        </a>
    </div>
    
    <div class="flex items-center md:order-2">
        <a href="{{ route('profile.index') }}" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false">
            <span class="sr-only">Open user menu</span>
            <img src="{{ asset('storage/image/animasi.png') }}" class="w-8" alt="">
        </a>
    </div>
  </div>
</nav>
<main class="pt-16 h-screen sm:overflow-y-auto">
    @yield('content')
</main>
@stack('map')
@stack('map-view')
@stack('api-script')
</body>
</html>