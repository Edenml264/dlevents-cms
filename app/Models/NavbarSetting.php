<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavbarSetting extends Model
{
    protected $fillable = [
        'logo_path',
        'show_contact_button',
        'contact_phone',
        'social_links'
    ];

    protected $casts = [
        'show_contact_button' => 'boolean',
        'social_links' => 'array'
    ];

    // Helper para obtener la configuración actual
    public static function getCurrentSettings()
    {
        return static::firstOrCreate([], [
            'show_contact_button' => false,
            'social_links' => [
                'facebook' => '',
                'instagram' => '',
                'twitter' => '',
                'youtube' => ''
            ]
        ]);
    }
}
