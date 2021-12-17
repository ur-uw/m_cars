<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpareType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image'
    ];
    /**
     * Get all of the spareParts for the SpareType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function spareParts(): HasMany
    {
        return $this->hasMany(SparePart::class);
    }
}
