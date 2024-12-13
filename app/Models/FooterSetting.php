<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifier',
        'content',
    ];

    /**
     * Get the current footer settings.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getCurrentSettings()
    {
        return static::all();
    }
}
