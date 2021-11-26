<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'color',
        'is_four_wheel',
        'tank_capacity',
        'fuel_type',
        'fuel_economy',
        'battery_capacity',
        'top_speed',
        'acceleration',
        'seating_capacity',
        'is_auto_drive',
        'plate_number',
        'driving_mode',
        'manufactured_at',
        'description',
        'price',
        'number_of_cylinders',
        'engine_capacity',
        'gearbox_speeds',
        'car_id'
    ];


    /**
     * Get the car that owns the CarDetails
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
