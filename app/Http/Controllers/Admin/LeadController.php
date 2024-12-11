<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::latest()->paginate(10);
        return view('admin.leads.index', compact('leads'));
    }

    public function show(Lead $lead)
    {
        return view('admin.leads.show', compact('lead'));
    }

    public function edit(Lead $lead)
    {
        return view('admin.leads.edit', compact('lead'));
    }

    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'status' => 'required|in:nuevo,contactado,en_seguimiento,convertido,perdido',
            'notes' => 'nullable|string',
            'budget' => 'nullable|numeric',
            'guests_count' => 'nullable|integer',
        ]);

        $lead->update($validated);
        $lead->update(['last_contact' => now()]);

        return redirect()->route('admin.leads.show', $lead)
            ->with('success', 'Lead actualizado correctamente.');
    }
}
