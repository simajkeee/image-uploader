<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageUploader extends Controller
{
    public function index()
    {
        return view('imageUploader.index');
    }

    public function store(Request $request): Image
    {
        if (!$request->file('image')) {
            return response()->json(['err' => 'Image is not present.'], 400);
        }

        $request->validate(['image' => 'required|file|max:10000|image']);

        $filepath = $request->file('image')->store('public/images');

        if (!$filepath) {
            return response()->json(['err' => 'Unable to store the file.'], 500);
        }

        $file = $request->file('image');

        return Image::create([
            'name' => $file->hashName(),
            'extension' => $file->extension(),
            'size' => $file->getSize(),
        ]);
    }
}
