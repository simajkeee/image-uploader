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

    public function show()
    {
        return Image::latest()->pluck('name');
    }

    public function store(Request $request)
    {
        if (!$request->file('image')) {
            return response()->json(['error' => 'Image is not present.'], 400);
        }

        $request->validate(['image' => 'required|file|max:2000|image|mimes:jpeg,jpg,png']);

        $filepath = $request->file('image')->store('public/images');

        if (!$filepath) {
            return response()->json(['error' => 'Unable to store the file.'], 500);
        }

        $file = $request->file('image');

        $image = Image::create([
            'name' => $file->hashName(),
            'extension' => $file->extension(),
            'size' => $file->getSize(),
        ]);

        return $image->name;
    }
}
