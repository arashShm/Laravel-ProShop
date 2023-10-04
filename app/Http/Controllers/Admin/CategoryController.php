<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category ;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('parent' , 0)->paginate(10);
        return view('admin.categories.all' , compact('categories')) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if($request->parent){
            $request->validate([
                'parent' => 'exists:categories,id'
            ]);
        }

        $request->validate([
            'name' => 'required|min:3'
        ]);

        Category::create([
            'name' => $request->name,
            'parent' => $request->parent ?? 0
        ]);
        alert()->success('Category Created SUCCESSFULLY' , 'Creation Complete');
        return redirect(route('admin.categories.index')) ;

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
    public function edit(Category $category)
    {
        return view('admin.categories.edit' , compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if($request->parent){
            $request->validate([
                'parent' => 'exists:categories,id'
            ]);
        }


        $request->validate([
            'name' => 'required|min:3'
        ]);

        $category->update([
            'name' => $request->name,
            'parent' => $request->parent 
        ]);
        alert()->success('Category Edited SUCCESSFULLY' , 'Edition Complete');
        return redirect(route('admin.categories.index')) ;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        alert()->success('Category Deleted SUCCESSFULLY' , 'Delete Complete');
        return redirect(route('admin.categories.index')) ;

    }



    
}
