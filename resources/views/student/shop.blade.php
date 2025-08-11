{{-- <x-app-layout>
@section('content')
<h2 class="text-2xl font-bold mb-4">Shop Products</h2>
<form method="POST" action="{{ route('order.store') }}">
    @csrf
    <div class="grid grid-cols-3 gap-4">
        @foreach($products as $product)
        <div class="border p-4 rounded">
            @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-40 object-cover mb-2">
            @endif
            <h3 class="font-bold">{{ $product->name }}</h3>
            <p>Rs {{ $product->price }}</p>
            <input type="number" name="cart[{{ $loop->index }}][qty]" value="1" min="1" class="border w-16">
            <input type="hidden" name="cart[{{ $loop->index }}][id]" value="{{ $product->id }}">
        </div>
        @endforeach
    </div>
    <button type="submit" class="mt-4 px-4 py-2 bg-green-600 text-white rounded">Buy Now</button>
</form>
</x-app-layout> --}}
