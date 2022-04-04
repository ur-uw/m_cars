<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServicePlaceType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    /**
     * Get all of the servicePlaces for the ServicePlaceType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servicePlaces(): HasMany
    {
        return $this->hasMany(ServicePlace::class);
    }
}
