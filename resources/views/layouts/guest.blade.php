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
  <div class="flex justify-center items-center p-4">
    <a href="{{ url('/') }}">
        <img src="{{ asset('storage/image/judul.png') }}" class="h-8" alt="SPBKLU Logo" />
    </a>
  </div>
</nav>
<main class="pt-16 h-screen sm:overflow-y-auto">
    @yield('content')
</main>
@stack('map')
@stack('map-view')
@stack('api-script')
@stack('detail-api')
</body>
</html>