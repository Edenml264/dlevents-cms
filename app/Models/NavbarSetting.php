<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class NavbarSetting extends Model
{
    protected $fillable = [
        'logo',
        'show_contact_button',
        'contact_button_text',
        'social_links'
    ];

    protected $casts = [
        'show_contact_button' => 'boolean',
        'social_links' => 'array'
    ];

    protected $attributes = [
        'show_contact_button' => false,
        'contact_button_text' => 'Contáctanos',
        'social_links' => '[]'
    ];

    protected $appends = ['logo_url'];

    public static function getCurrentSettings()
    {
        return static::firstOrCreate([], [
            'show_contact_button' => false,
            'contact_button_text' => 'Contáctanos',
            'social_links' => []
        ]);
    }

    public function getLogoUrlAttribute()
    {
        if (!$this->logo) {
            return null;
        }

        // Si la ruta ya es una URL completa, devuélvela
        if (filter_var($this->logo, FILTER_VALIDATE_URL)) {
            return $this->logo;
        }

        // Si la ruta comienza con /storage, conviértela a URL
        if (str_starts_with($this->logo, '/storage')) {
            return url($this->logo);
        }

        // Si es una ruta relativa, conviértela a URL
        return Storage::disk('public')->url($this->logo);
    }
}
