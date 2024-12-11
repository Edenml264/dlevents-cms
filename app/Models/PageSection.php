<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = [
        'name',
        'identifier',
        'content',
        'type',
        'metadata',
        'is_active',
        'order'
    ];

    protected $casts = [
        'metadata' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    // Scope para obtener secciones activas
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope para ordenar por el campo order
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
