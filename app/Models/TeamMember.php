<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'name',
        'slug',
        'designation',
        'email',
        'phone',
        'address',
        'biography',
        'facebook',
        'linkedin',
        'instagram',
        'nickname',   // NOVO: add column
        'admin_id',   // NOVO: FK
    ];

    // Relacija: član tima pripada jednom adminu (opciono)
    public function admin()
    {
        return $this->belongsTo(\App\Models\Admin::class, 'admin_id');
    }

    /* --- Opciono, ali korisno --- */

    // Lokalni scope za pretragu (koristiš u index-u API/web kontroleru)
    public function scopeSearch($q, ?string $term)
    {
        if (!$term) return $q;
        return $q->where(function ($w) use ($term) {
            $w->where('name', 'like', "%{$term}%")
              ->orWhere('designation', 'like', "%{$term}%")
              ->orWhere('email', 'like', "%{$term}%")
              ->orWhere('phone', 'like', "%{$term}%");
        });
    }
}
