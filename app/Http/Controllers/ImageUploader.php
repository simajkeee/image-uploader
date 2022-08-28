<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploader extends Controller
{
    public function index()
    {
        return view('imageUploader.index');
    }

    public function store(Request $request)
    {
        // upload images
    }
}
