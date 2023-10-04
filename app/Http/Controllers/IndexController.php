<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    

    public function index()
    {
        $this->seo()->setTitle('Main Page');
        return view('index');
    }
}
