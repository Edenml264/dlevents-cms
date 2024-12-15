<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\SiteSetting;
use App\Models\NavbarSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CmsController extends Controller
{
    public function index()
    {
        $pages = Page::all()->mapWithKeys(function ($page) {
            return [$page->identifier => $page->name];
        });

        return view('admin.cms.index', compact('pages'));
    }

    public function settings()
    {
        $settings = collect(SiteSetting::orderBy('order')->get())
            ->groupBy('group')
            ->map(function ($group) {
                return $group->keyBy('key');
            });
            
        $navbarSettings = NavbarSetting::getCurrentSettings();
        
        return view('admin.cms.settings', compact('settings', 'navbarSettings'));
    }

    public function updateSettings(Request $request)
    {
        Log::info('Iniciando actualización de configuraciones', [
            'has_settings' => $request->has('settings'),
            'has_navbar' => $request->has('navbar')
        ]);

        try {
            DB::beginTransaction();

            // 1. Actualizar configuraciones generales
            if ($request->has('settings')) {
                foreach ($request->settings as $key => $value) {
                    $setting = SiteSetting::where('key', $key)->first();
                    
                    if ($setting) {
                        if ($setting->type === 'image' && $request->hasFile("settings.{$key}")) {
                            // Eliminar imagen anterior si existe
                            if ($setting->value) {
                                $oldPath = str_replace('/storage/', '', $setting->value);
                                if (Storage::disk('public')->exists($oldPath)) {
                                    Storage::disk('public')->delete($oldPath);
                                }
                            }
                            
                            $file = $request->file("settings.{$key}");
                            $path = $file->store('settings', 'public');
                            $value = 'storage/' . $path;
                            
                            Log::info("Imagen actualizada para {$key}", ['path' => $value]);
                        }
                        
                        // Usar el método setCached en lugar de update directo
                        SiteSetting::setCached($key, $value);
                        Log::info("Configuración actualizada: {$key}", ['value' => $value]);
                    }
                }
            }

            // 2. Actualizar configuraciones del navbar
            if ($request->has('navbar')) {
                $navbarSettings = NavbarSetting::getCurrentSettings();
                
                if ($request->hasFile('navbar.logo')) {
                    // Eliminar logo anterior si existe
                    if ($navbarSettings->logo) {
                        $oldPath = str_replace('/storage/', '', $navbarSettings->logo);
                        if (Storage::disk('public')->exists($oldPath)) {
                            Storage::disk('public')->delete($oldPath);
                        }
                    }
                    
                    $file = $request->file('navbar.logo');
                    $path = $file->store('navbar', 'public');
                    $navbarSettings->logo = 'storage/' . $path;
                    
                    Log::info('Logo del navbar actualizado', ['path' => $navbarSettings->logo]);
                }

                $navbarSettings->show_contact_button = $request->boolean('navbar.show_contact_button');
                $navbarSettings->contact_button_text = $request->input('navbar.contact_button_text');
                $navbarSettings->social_links = $request->input('navbar.social_links', []);
                $navbarSettings->save();

                // Limpiar caché después de actualizar configuraciones
                SiteSetting::clearCache();
                
                Log::info('Configuraciones del navbar actualizadas', [
                    'show_button' => $navbarSettings->show_contact_button,
                    'button_text' => $navbarSettings->contact_button_text
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Configuraciones actualizadas correctamente');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar configuraciones: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al actualizar las configuraciones');
        }
    }

    public function editPage(Page $page)
    {
        $sections = $page->sections()->orderBy('order')->get();
        return view('admin.cms.page.edit', compact('page', 'sections'));
    }

    public function updatePage(Request $request, Page $page)
    {
        $page->update($request->validated());
        return back()->with('success', 'Página actualizada correctamente');
    }

    public function preview(Page $page)
    {
        return view('pages.' . $page->identifier, compact('page'));
    }

    public function sections(Page $page)
    {
        $sections = $page->sections()->orderBy('order')->get();
        return view('admin.cms.sections.index', compact('page', 'sections'));
    }

    public function editSection(PageSection $section)
    {
        return view('admin.cms.sections.edit', compact('section'));
    }

    public function updateSection(Request $request, PageSection $section)
    {
        try {
            $data = $request->validate([
                'title' => 'nullable|string|max:255',
                'content' => 'required|string',
                'order' => 'required|integer|min:1',
                'is_active' => 'required|in:0,1'
            ]);

            $data['is_active'] = (bool)$data['is_active'];

            $section->update($data);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Sección actualizada correctamente'
                ]);
            }

            return back()->with('success', 'Sección actualizada correctamente');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error de validación',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al actualizar la sección: ' . $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }
}
