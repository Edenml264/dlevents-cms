<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'name',
        'url',
        'type',
        'order',
        'parent_id',
        'is_active',
        'open_in_new_tab'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'open_in_new_tab' => 'boolean',
        'order' => 'integer'
    ];

    // Relación con elementos hijos
    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }

    // Relación con elemento padre
    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    // Scope para obtener elementos activos
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope para obtener elementos principales (sin padre)
    public function scopeMain($query)
    {
        return $query->whereNull('parent_id');
    }

    // Scope para ordenar elementos
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
