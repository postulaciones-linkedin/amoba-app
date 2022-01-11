<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_plan_id',
        'route_id',
        'track_id',
        'reservation_start',
        'reservation_end',
        'route_stop_origin_id',
        'route_stop_destination_id',
        'enabled'
    ];
}
