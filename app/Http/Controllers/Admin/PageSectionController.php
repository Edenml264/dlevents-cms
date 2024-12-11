<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageSectionController extends Controller
{
    public function index()
    {
        $sections = PageSection::ordered()->get();
        return view('admin.cms.sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.cms.sections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'identifier' => 'required|string|max:255|unique:page_sections',
            'content' => 'required|string',
            'type' => 'required|string|in:text,html,image,gallery',
            'is_active' => 'boolean',
            'order' => 'integer',
            'metadata' => 'nullable|array'
        ]);

        // Generar identificador único si no se proporciona
        if (empty($validated['identifier'])) {
            $validated['identifier'] = Str::slug($validated['name']);
        }

        PageSection::create($validated);

        return redirect()->route('admin.cms.sections.index')
            ->with('success', 'Sección creada exitosamente.');
    }

    public function edit(PageSection $section)
    {
        return view('admin.cms.sections.edit', compact('section'));
    }

    public function update(Request $request, PageSection $section)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'identifier' => 'required|string|max:255|unique:page_sections,identifier,' . $section->id,
            'content' => 'required|string',
            'type' => 'required|string|in:text,html,image,gallery',
            'is_active' => 'boolean',
            'order' => 'integer',
            'metadata' => 'nullable|array'
        ]);

        $section->update($validated);

        return redirect()->route('admin.cms.sections.index')
            ->with('success', 'Sección actualizada exitosamente.');
    }

    public function destroy(PageSection $section)
    {
        $section->delete();

        return redirect()->route('admin.cms.sections.index')
            ->with('success', 'Sección eliminada exitosamente.');
    }
}
