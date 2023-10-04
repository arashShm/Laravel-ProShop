<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductGallery ;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $images = $product->gallery()->latest()->paginate(30);
        return view('admin.products.gallery.all' , compact('product' , 'images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return view('admin.products.gallery.create' , compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Product $product)
    {

        $data = $request->validate([
            'images.*.image' => 'required',
            'images.*.alt' => 'required|min:3'
        ]);
 

        collect($data['images'])->each(function($image) use ($product) {
            $product->gallery()->create($image);
        });



        
        alert()->success('Gallery Created SUCCESSFULLY' , 'Creation Complete');
        return redirect(route('admin.product.gallery.index' , ['product' => $product->id])) ;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product , ProductGallery $gallery)
    {
        return view('admin.products.gallery.edit', compact('product' , 'gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product , ProductGallery $gallery)
    {
        $validated = $request->validate([
            'image' => 'required',
            'alt' => 'required|min:3'
        ]);

        $gallery->update($validated);

        // alert()->success()
        return redirect(route('admin.product.gallery.index' , ['product' => $product->id]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product , ProductGallery $gallery)
    {
        $gallery->delete();
        // alert()->success()

        return redirect(route('admin.product.gallery.index' , ['product' => $product->id]));
    }
}
