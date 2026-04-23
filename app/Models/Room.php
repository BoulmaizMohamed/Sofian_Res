<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = ['name', 'description', 'capacity'];

    public function beds(): HasMany
    {
        return $this->hasMany(Bed::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function getAvailableBedsCountAttribute(): int
    {
        return $this->beds()->where('status', 'available')->count();
    }

    public function getReservedBedsCountAttribute(): int
    {
        return $this->beds()->where('status', 'reserved')->count();
    }
}
