<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BedBooking extends Model
{
    protected $fillable = [
        'bed_id',
        'client_name',
        'phone_number',
        'national_id',
        'date',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    public function bed(): BelongsTo
    {
        return $this->belongsTo(Bed::class);
    }
}
