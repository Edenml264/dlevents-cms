<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            
            // Guardar el archivo en el storage
            $path = $file->storeAs('public/uploads', $fileName);
            
            return response()->json([
                'location' => Storage::url($path),
                'fileName' => $fileName
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al subir el archivo: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($fileName)
    {
        try {
            if (Storage::exists('public/uploads/' . $fileName)) {
                Storage::delete('public/uploads/' . $fileName);
                return response()->json(['message' => 'Archivo eliminado correctamente']);
            }
            
            return response()->json(['error' => 'Archivo no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al eliminar el archivo: ' . $e->getMessage()
            ], 500);
        }
    }
}
