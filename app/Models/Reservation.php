<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $fillable = [
        'full_name',
        'phone_number',
        'reservation_type',
        'num_beds',
        'date',
        'status',
        'notes',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
