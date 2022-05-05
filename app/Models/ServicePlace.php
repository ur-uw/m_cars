<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServicePlace extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'phone_number',
        'latitude',
        'longitude',
        'service_place_type_id'
    ];

    /**
     * Get the servicePlaceType that owns the ServicePlace
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servicePlaceType(): BelongsTo
    {
        return $this->belongsTo(ServicePlaceType::class);
    }
}
