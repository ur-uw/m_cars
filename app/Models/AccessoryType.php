<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccessoryType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image'
    ];
    /**
     * Get all of the accessories for the AccessoryType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accessories(): HasMany
    {
        return $this->hasMany(Accessory::class);
    }
}
