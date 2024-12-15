<?php

namespace App\Models;

use App\Traits\CacheableSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class NavbarSetting extends Model
{
    use CacheableSetting;

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
        'show_contact_button' => true,
        'contact_button_text' => 'Contáctanos',
        'social_links' => '[]'
    ];

    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset($this->logo) : null;
    }

    public static function getCurrentSettings()
    {
        return Cache::remember('navbar_settings', static::$cacheTime, function () {
            $settings = static::first();
            
            if (!$settings) {
                $settings = static::create([
                    'show_contact_button' => true,
                    'contact_button_text' => 'Contáctanos',
                    'social_links' => []
                ]);
            }
            
            return $settings;
        });
    }

    public static function clearNavbarCache()
    {
        Cache::forget('navbar_settings');
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            static::clearNavbarCache();
        });
    }
}
