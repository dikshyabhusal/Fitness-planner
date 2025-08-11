<?php
namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    // Show all products with stock > 0 paginated
    public function shop()
    {
        $products = Product::where('stock', '>', 0)->paginate(12);
        return view('shop.index', compact('products'));
    }
}
