@extends('layouts.template')
@section('content')

<div class="flex flex-col p-2 h-full overflow-y-auto">
    <h1 class="font-semibold text-center">{{ $terms['content'] }}</h1>
    <p>{{ $terms['title'] }}</p>
</div>
@endsection