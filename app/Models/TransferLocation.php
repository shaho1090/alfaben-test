<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransferLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_id',
        'arriving_time',
        'leaving_time',
        'starting_km',
        'ending_km'
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
