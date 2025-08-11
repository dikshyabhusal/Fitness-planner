<div>
    <div class="container mx-auto py-6">
    <div class="grid grid-cols-3 gap-6">
        <!-- Products -->
        <div class="col-span-2">
            <h2 class="text-2xl font-bold mb-4">Shop Products</h2>
            <div class="grid grid-cols-2 gap-4">
                @foreach($products as $p)
                <div class="border p-4 rounded">
                    @if(!empty($p['image']))
                        <img src="{{ asset('storage/'.$p['image']) }}" class="w-full h-40 object-cover mb-2">
                    @endif
                    <h3 class="font-bold">{{ $p['name'] }}</h3>
                    <p>Rs {{ number_format($p['price'],2) }}</p>
                    <p class="text-sm text-gray-500">Stock: {{ $p['stock'] }}</p>
                    <button wire:click="addToCart({{ $p['id'] }})" class="mt-2 bg-green-600 text-white px-3 py-1 rounded">Add to cart</button>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Cart -->
        <div class="col-span-1">
            <h2 class="text-xl font-bold mb-4">Cart</h2>
            @if(empty($cart))
                <p class="text-gray-500">Cart is empty</p>
            @else
                <div class="space-y-3">
                    @foreach($cart as $i => $item)
                        @php
                            $prod = \App\Models\Product::find($item['product_id']);
                        @endphp
                        <div class="border p-3 rounded flex justify-between items-center">
                            <div>
                                <div class="font-semibold">{{ $prod?->name ?? 'Product' }}</div>
                                <div class="text-sm">Rs {{ $prod?->price ?? '0' }}</div>
                            </div>

                            <div class="flex items-center space-x-2">
                                <button wire:click="decrease({{ $i }})" class="px-2 py-1 border rounded">-</button>
                                <div class="px-3">{{ $item['qty'] }}</div>
                                <button wire:click="increase({{ $i }})" class="px-2 py-1 border rounded">+</button>
                                <button wire:click="remove({{ $i }})" class="ml-2 text-red-600">Remove</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    <div class="font-bold">Total: Rs {{ number_format($cartTotal,2) }}</div>
                    <button wire:click="checkout" class="mt-2 w-full bg-blue-600 text-white px-4 py-2 rounded">Checkout & Pay</button>
                </div>
            @endif
        </div>
    </div>
</div>

</div>
