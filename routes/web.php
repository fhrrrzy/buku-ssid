<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Str; // Import Str helper
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload-test', function () {
    return view('upload-test');
});

Route::post('/upload-test', function (Request $request) {
    // Validate uploaded file
    $request->validate([
        'file' => 'required|file|max:5120', // Max size 5MB
    ]);

    // Store the uploaded file in storage/app/public/test-uploads
    $path = $request->file('file')->store('test-uploads', 'public');

    return response()->json([
        'message' => 'File uploaded successfully!',
        'file_url' => Storage::url($path),
    ]);
});
