<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'owner_id',
        'number_plate',
        'detail_id',
        'last_mod_date',
        'is_active',
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class,'driver_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class,'owner_id');
    }

}
