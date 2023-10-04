<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product ;

class ProductController extends Controller
{
    

    public function index()
    {
        $products = Product::latest()->paginate(12);
        return view('home.products' , compact('products'));
    }


    public function single(Product $product)
    {
        
        return view('home.single-product' , compact('product')) ;
    }



}
