@extends('layouts.template')
@section('content')
@section('breadcrumb')
@include('layouts.breadcrumb')
@endsection

<div class="flex p-2">
    <img src="{{ $data['image'] }}" class="w-full rounded" alt="">
</div>
<div class="flex flex-col p-2 space-y-3 justify-between">
    <form action="{{ route('transaction.book', $id) }}" method="POST" class="flex flex-col justify-between">
        @csrf
        <div>
            <div class="bg-white rounded-lg border-2 p-2 w-full mt-2">
                <h1 class="font-semibold text-lg text-gray-800">{{ $data['name'] }}</h1>
                <p class="text-sm">{{ $slotTotal }} slot</p>
            </div>
            <div class="bg-white rounded-lg border-2 w-full mt-2 flex justify-between items-center space-x-2 p-2">
                <div class="inline-flex space-x-2">
                    <div class="bg-gray-100 p-2 rounded-full">
                        <span class="w-24">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 256 256"><path d="M200,56H32A24,24,0,0,0,8,80v96a24,24,0,0,0,24,24H200a24,24,0,0,0,24-24V80A24,24,0,0,0,200,56Zm8,120a8,8,0,0,1-8,8H32a8,8,0,0,1-8-8V80a8,8,0,0,1,8-8H200a8,8,0,0,1,8,8ZM192,96v64a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V96a8,8,0,0,1,8-8H184A8,8,0,0,1,192,96Zm64,0v64a8,8,0,0,1-16,0V96a8,8,0,0,1,16,0Z"></path></svg>
                        </span>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <h1 class="font-semibold">Available</h1>
                        <p class="text-sm">{{ $slotCount }} slot</p>
                    </div>
                </div>
            </div>
            <div class="w-full bg-white rounded-lg border-2 p-2 mt-2">
                <h1 class="font-medium">Information</h1>
                <p>...</p>
            </div>
        </div>
        <div class="mt-2">
            @if($slotCount == 0)
                <button type="submit" class="rounded-full bg-gray-600 px-4 py-2.5 items-center order-2 text-white font-bold w-full" disabled>Order</button>
            @else
                <button type="submit" class="rounded-full bg-green-600 px-4 py-2.5 items-center order-2 text-white font-bold w-full">Order</button>
            @endif
        </div>
    </form>
</div>
<script>
    function decrement(e) {
        const btn = e.target.parentNode.parentElement.querySelector(
        'button[data-action="decrement"]'
        );
        const target = btn.nextElementSibling;
        let value = Number(target.value);
        value--;
        target.value = value;
    }

    function increment(e) {
        const btn = e.target.parentNode.parentElement.querySelector(
            'button[data-action="decrement"]'
        );
        const target = btn.nextElementSibling;
        let value = Number(target.value);
        value++;
        target.value = value;
    }

    const decrementButtons = document.querySelectorAll(
        `button[data-action="decrement"]`
    );

    const incrementButtons = document.querySelectorAll(
        `button[data-action="increment"]`
    );

    decrementButtons.forEach(btn => {
        btn.addEventListener("click", decrement);
    });

    incrementButtons.forEach(btn => {
        btn.addEventListener("click", increment);
    });
</script>
@endsection