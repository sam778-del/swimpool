<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('front.book');
    }

    public function showMap()
    {
        return view('front.map');
    }

    public function insertMap(Request $request)
    {
        return $request->all();
    }
}
