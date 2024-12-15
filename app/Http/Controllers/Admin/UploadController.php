<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function image(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads/images', 'public');
            
            return response()->json([
                'location' => Storage::url($path)
            ]);
        }
        
        return response()->json(['error' => 'No file uploaded.'], 400);
    }
}
