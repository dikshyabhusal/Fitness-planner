@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold mb-6">Add New Product</h1>

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="max-w-md">
    @csrf
    <div class="mb-4">
        <label class="block font-semibold mb-1">Product Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded p-2" required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Price (Rs)</label>
        <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full border border-gray-300 rounded p-2" required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Stock Quantity</label>
        <input type="number" name="stock" value="{{ old('stock') ?? 0 }}" class="w-full border border-gray-300 rounded p-2" required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Description</label>
        <textarea name="description" rows="4" class="w-full border border-gray-300 rounded p-2">{{ old('description') }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Product Image</label>
        <input type="file" name="image" accept="image/*" class="w-full">
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Add Product</button>
</form>
@endsection
