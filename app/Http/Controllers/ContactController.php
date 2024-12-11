<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'event_type' => 'required|string|max:255',
            'event_date' => 'required|date',
            'message' => 'required|string',
        ]);

        try {
            // Crear el lead
            Lead::create($validated);

            // Enviar el email
            Mail::to('ventas@edenmendez.com')->send(new ContactFormMail($validated));
            
            return redirect()->back()->with('success', '¡Mensaje enviado con éxito! Nos pondremos en contacto contigo pronto.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['email' => 'Hubo un problema al enviar el mensaje. Por favor, intenta nuevamente.']);
        }
    }
}
