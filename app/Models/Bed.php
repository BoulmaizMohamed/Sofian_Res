<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bed extends Model
{
    protected $fillable = [
        'room_id',
        'name',
        'status',
        'client_name',
        'phone_number',
        'national_id',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

    public function isReserved(): bool
    {
        return $this->status === 'reserved';
    }
}
