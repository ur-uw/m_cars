<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Manufacturer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'country',
    ];


    /**
     * Get all of the cars for the Manufacturer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }

    /**
     * Get all of the products for the Manufacturer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
