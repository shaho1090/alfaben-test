<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'registered_at',
        'registrant_id',
        'vehicle_id',
        'driver_id',
        'started_at',
        'completed_at',
        'status'
    ];

    public function locations(): HasMany
    {
        return $this->hasMany(TransferLocation::class,'transfer_id');
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class,'vehicle_id');
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class,'driver_id');
    }

    public function passengers(): HasMany
    {
        return $this->hasMany(TransferPassenger::class,'transfer_id');
    }
}
