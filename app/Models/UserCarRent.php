<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserCarRent extends Model
{
    use HasFactory;
    protected $table = 'user_car_rent';
    public $timestamps = false;

    protected $fillable = [
        'start_date',
        'end_date',
        'user_id',
        'car_id',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime:Y-m-d h:i:s',
        'end_date' => 'datetime:Y-m-d h:i:s',
    ];
    /**
     * Get the user that owns the UserCarRent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the car that owns the UserCarRent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
