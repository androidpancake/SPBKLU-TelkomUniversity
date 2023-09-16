@extends('layouts.template')
@section('content')
@if($message('error'))
    <span>{{ $message('error') }}</span>
@endif
<h1>Maaf terjadi kesalahan</h1>
@endsection