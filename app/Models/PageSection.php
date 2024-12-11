<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = [
        'name',
        'identifier',
        'page',
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

    // Scope para filtrar por página
    public function scopeForPage($query, $page)
    {
        return $query->where('page', $page);
    }

    // Método para obtener el contenido formateado
    public function getFormattedContentAttribute()
    {
        switch ($this->type) {
            case 'image':
                return '<img src="' . asset('storage/' . $this->content) . '" alt="' . $this->name . '" class="max-w-full h-auto rounded-lg shadow-lg">';
            case 'gallery':
                $images = json_decode($this->content, true);
                if (!is_array($images)) return '';
                
                $html = '<div class="grid grid-cols-2 md:grid-cols-3 gap-4">';
                foreach ($images as $image) {
                    $html .= '<img src="' . asset('storage/' . $image) . '" alt="Galería" class="w-full h-48 object-cover rounded-lg shadow-sm">';
                }
                $html .= '</div>';
                return $html;
            case 'html':
                return $this->content;
            default:
                return nl2br(e($this->content));
        }
    }
}
