@extends('layout.layout')
   
@section('content')

@if(session('success'))
    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="font-bold">Informational message</p>
        <p class="text-sm">{{ session('success') }}</p>
    </div>
@endif

<div class="m-10 p-5 border-2">
    <div class="flex justify-center">
        <div class="block">
            <div>
                Name : {{ $product->name }}
            </div>
            <div>
                Description : {{ $product->description }}
            </div>
            <div>
                Price : {{ $product->price }}円
            </div>
            <button class="bg-yellow-300 hover:bg-yellow-500 text-white py-1 px-4 rounded-full" onclick="location.href='{{ route('add.cart', $product->id) }}'">
                Add to cart
            </button>
        </div>
    </div>
</div>
    
@endsection