@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold mb-6">Manage Products</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

<a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
    + Add New Product
</a>

<table class="w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 p-2">Image</th>
            <th class="border border-gray-300 p-2">Name</th>
            <th class="border border-gray-300 p-2">Price (Rs)</th>
            <th class="border border-gray-300 p-2">Stock</th>
            <th class="border border-gray-300 p-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr>
            <td class="border border-gray-300 p-2">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="Image" class="h-16 w-16 object-cover rounded">
                @else
                    <span class="text-gray-400">No Image</span>
                @endif
            </td>
            <td class="border border-gray-300 p-2">{{ $product->name }}</td>
            <td class="border border-gray-300 p-2">{{ number_format($product->price, 2) }}</td>
            <td class="border border-gray-300 p-2">{{ $product->stock }}</td>
            <td class="border border-gray-300 p-2 space-x-2">
                <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:underline">Edit</a>

                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="p-4 text-center text-gray-500">No products found.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $products->links() }}
</div>
@endsection
