@extends('layout.layout')

@section('content')

@if(session('success'))
    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="font-bold">Informational message</p>
        <p class="text-sm">{{ session('success') }}</p>
    </div>
@endif

<div class="container mx-auto p-6 grid grid-cols-4 gap-4">
    @foreach($products as $product)
        <div class="col-span-1 flex flex-col bg-white border-2 p-4" 
            style="margin:10px; padding:5px; border:3px solid black;">
            <div onclick="location.href='{{ route('show', $product->id) }}'"
                style="cursor:pointer;">
                <div class="bg-red-200 items-center text-center">{{ $product->name }}</div>
                <p><strong>Description: </strong>{{ $product->description }}</p>
                <p><strong>Price: </strong> {{ $product->price }}円</p>
            </div>
            <div class="flex flex-wrap mt-auto justify-center">
                <button class="bg-yellow-300 hover:bg-yellow-500 text-white py-1 px-4 rounded-full" onclick="location.href='{{ route('add.cart', $product->id) }}'">
                    Add to cart
                </button>
            </div>
        </div>
    @endforeach
</div>


@endsection