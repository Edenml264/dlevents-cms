<?php

namespace App\Models;

use App\Traits\CacheableSetting;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use CacheableSetting;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description',
        'options',
        'order'
    ];

    protected $casts = [
        'options' => 'array'
    ];

    /**
     * @deprecated Use getCached() instead
     */
    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * @deprecated Use setCached() instead
     */
    public static function set($key, $value)
    {
        $setting = static::where('key', $key)->first();
        if ($setting) {
            $setting->update(['value' => $value]);
        }
        return $setting;
    }
}
