<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'event_type',
        'event_date',
        'message',
        'status',
        'notes',
        'budget',
        'guests_count',
        'last_contact'
    ];

    protected $casts = [
        'event_date' => 'date',
        'last_contact' => 'datetime',
        'budget' => 'decimal:2'
    ];

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'nuevo' => 'bg-blue-100 text-blue-800',
            'contactado' => 'bg-yellow-100 text-yellow-800',
            'en_seguimiento' => 'bg-purple-100 text-purple-800',
            'convertido' => 'bg-green-100 text-green-800',
            'perdido' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
