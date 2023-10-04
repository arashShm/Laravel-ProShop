<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth' , 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        alert()->success('welcome to shop', 'Message');
        return view('home');
    }


    public function comments(Request $request)
    {
        // if(! $request->ajax()){
        //     return response()->json([
        //         'status' => 'only ajax request'
        //     ]);
        // }

        $data = $request->validate([
            'commentable_id' => 'required',
            'commentable_type' => 'required', 
            'parent_id' => 'required',
            'comment' => 'required'
        ]);

        auth()->user()->comments()->create($data);


        return response()->json([
            'status' => 'success'
        ]);
        alert()->success('Your Comment Sent SUCCESSFULLY') ;
        return back();


        
    }


}
