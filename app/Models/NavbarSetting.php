<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public static function getCurrentSettings()
    {
        return static::firstOrCreate([]);
    }
}
