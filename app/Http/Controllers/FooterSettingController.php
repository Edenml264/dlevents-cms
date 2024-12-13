<?php

namespace App\Http\Controllers;

use App\Models\FooterSetting;
use Illuminate\Http\Request;

class FooterSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $footerSettings = FooterSetting::all();
        return view('admin.cms.footer.index', compact('footerSettings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cms.footer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'identifier' => 'required|unique:footer_settings',
            'content' => 'required',
        ]);

        FooterSetting::create($request->all());

        return redirect()->route('footer-settings.index')
                         ->with('success', 'Footer setting created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FooterSetting  $footerSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(FooterSetting $footerSetting)
    {
        return view('admin.cms.footer.edit', compact('footerSetting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FooterSetting  $footerSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FooterSetting $footerSetting)
    {
        $request->validate([
            'identifier' => 'required|unique:footer_settings,identifier,'.$footerSetting->id,
            'content' => 'required',
        ]);

        $footerSetting->update($request->all());

        return redirect()->route('footer-settings.index')
                         ->with('success', 'Footer setting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FooterSetting  $footerSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(FooterSetting $footerSetting)
    {
        $footerSetting->delete();

        return redirect()->route('footer-settings.index')
                         ->with('success', 'Footer setting deleted successfully.');
    }
}
