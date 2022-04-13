<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'registered_at',
        'registrant_id',
        'preferred_vehicle_id',
        'preferred_driver_id',
        'started_at',
        'completed_at',
        'status'
    ];
}
