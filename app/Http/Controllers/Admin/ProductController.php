<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query();

        if ($keyword = request('search')) {
            $products->where('title', 'LIKE',  "%$keyword%")->orWhere('id', 'LIKE', "%$keyword%");
        }

        $products = $products->paginate(10);
        return view('admin.products.all', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
            'inventory' => 'required',
            'categories' => 'required',
            'attributes' => 'array'
        ]);


        // //file Upload 
        // $file = $request->file('image');
        // $destinationPath = '/img/' . now()->year . '/' . now()->month . '/' . now()->day . '/';
        // $file->move(public_path($destinationPath), $file->getClientOriginalName());
        // $data['image'] = $destinationPath . $file->getClientOriginalName();
        // ///

        $product = auth()->user()->products()->create($data);
        $product->categories()->sync($data['categories']);
        if (isset($data['attributes']))
            $this->attachAttributesToProduct($product, $data);


        alert()->success('Product Created SUCCESSFULLY', 'creation complete');
        return redirect(route('admin.products.index'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required' ,
            'inventory' => 'required',
            'attributes' => 'array',
            'categories' => 'required',
        ]);




        // if ($request->file('image')) {
        //     $request->validate([
        //         'image' => 'required|mimes:jpg,jpeg,png|max:2048'
        //     ]);

        //     // dd($request->file('image')) ;

        //     if (File::exists(public_path($product->image))) {
        //         File::delete(public_path($product->image));
        //     }
            
        //     $file = $request->file('image');
        //     $destinationPath = '/img/' . now()->year . '/' . now()->month . '/' . now()->day . '/';
        //     $file->move(public_path($destinationPath), $file->getClientOriginalName());
        //     $data['image'] = $destinationPath . $file->getClientOriginalName();
        // }


        $product->update($data);
        $product->categories()->sync($data['categories']);

        $product->attributes()->detach();

        if (isset($data['attributes']))
            $this->attachAttributesToProduct($product, $data);

        alert()->success('Product Edited SUCCESSFULLY', 'Edition complete');

        return redirect(route('admin.products.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        alert()->success('Product Deleted SUCCESSFULLY', 'Delete complete');

        return back();
    }




    protected function attachAttributesToProduct(Product $product, array $data): void
    {
        $attributes = collect($data['attributes']);
        $attributes->each(function ($item) use ($product) {

            if (is_null($item['name']) || is_null($item['value'])) return;

            $attr = Attribute::firstOrCreate([
                'name' => $item['name']
            ]);


            $attrValue = $attr->values()->firstOrCreate([
                'value' => $item['value']
            ]);


            $product->attributes()->attach($attr->id, ['value_id' => $attrValue->id]);
        });
    }
}
