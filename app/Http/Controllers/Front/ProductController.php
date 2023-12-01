<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

    }

    public function show(Product $product)
    {
        if(!$product->Active())
        {
            return 0; 
        }
        return view('products.show',compact('product'));
    }
}
