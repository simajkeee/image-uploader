<?php

use App\Http\Controllers\ImageUploader;
use Illuminate\Support\Facades\Route;

Route::get('/', [ImageUploader::class, 'index']);
Route::get('/preview', [ImageUploader::class, 'show']);
Route::post('/upload', [ImageUploader::class, 'store']);
