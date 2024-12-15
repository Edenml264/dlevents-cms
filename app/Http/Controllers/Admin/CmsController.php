<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

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
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('admin.cms.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Configuración actualizada correctamente');
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
