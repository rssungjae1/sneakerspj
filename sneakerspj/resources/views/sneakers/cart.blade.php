@extends('layout.layout')
  
@section('content')

@if(session('success'))
    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="font-bold">Informational message</p>
        <p class="text-sm">{{ session('success') }}</p>
    </div>
@endif

<div class="container flex justify-center mx-auto">
    <div class="flex flex-col">
        <div class="w-full">
            <div class="border-b border-gray-200 shadow">
                <table class="divide-y divide-gray-300 table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                Product
                            </th>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                Price
                            </th>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                Quantity
                            </th>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                Subtotal
                            </th>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                Delete
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0 @endphp
                        @if(session('cart'))
                            @foreach(session('cart') as $id => $cartdata)
                                @php $total += $cartdata['price'] * $cartdata['quantity'] @endphp
                                <tr class="whitespace-nowrap" data-id="{{ $id }}">
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $cartdata['name'] }}
                                    </td>
                                    <td class="px-6 py-4">{{ $cartdata['price'] }}円</td>
                                    <td class="px-6 py-4">
                                        <input type="number" value="{{ $cartdata['quantity'] }}" class="form-control quantity update-cart" />
                                    </td>
                                    <td class="px-6 py-4">{{ $cartdata['price'] * $cartdata['quantity'] }}円</td>
                                    <td class="px-6 py-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400 remove-from-cart" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" style="cursor:pointer;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-right"><h3><strong>Total {{ $total }}円</strong></h3></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
  
@section('scripts')
<script type="text/javascript">
    
    // change event
    // update.cart
    $(".update-cart").change(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            },
            error: function(data) {
                //
            }
        });
    });
    
    // click event
    // remove.from.cart
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        if(confirm("カートから外しましょうか?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                },
                error: function(data) {
                    //
                }
            });
        }
    });
  
</script>
@endsection