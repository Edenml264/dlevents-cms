<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavbarSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NavbarSettingController extends Controller
{
    public function edit()
    {
        $settings = NavbarSetting::getCurrentSettings();
        return view('admin.cms.navbar.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = NavbarSetting::getCurrentSettings();
        
        $validated = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'show_contact_button' => 'boolean',
            'contact_phone' => 'nullable|string|max:20',
            'social_links.facebook' => 'nullable|url',
            'social_links.instagram' => 'nullable|url',
            'social_links.twitter' => 'nullable|url',
            'social_links.youtube' => 'nullable|url',
        ]);

        if ($request->hasFile('logo')) {
            // Eliminar logo anterior si existe
            if ($settings->logo_path) {
                Storage::disk('public')->delete($settings->logo_path);
            }
            $path = $request->file('logo')->store('navbar', 'public');
            $settings->logo_path = $path;
        }

        $settings->show_contact_button = $request->boolean('show_contact_button');
        $settings->contact_phone = $request->contact_phone;
        $settings->social_links = $request->social_links;
        
        $settings->save();

        return back()->with('success', 'Configuración del navbar actualizada correctamente');
    }
}
