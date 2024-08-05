<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{


    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(12);
        return view('shop', ['products' => $products]);
    }

    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->first();

        // if (!$product) {
        //     // Handle the case where the product is not found
        //     return redirect()->route('product.notfound');
        // }

        $rproducts = Product::where('slug', '!=', $slug)->inRandomOrder()->take(5)->get();

        return view('details', [
            'product' => $product,
            'rproducts' => $rproducts
        ]);
    }
}
