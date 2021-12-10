<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SparePart extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'image',
        'spare_type_id',
        'manufacturer_id',
    ];

    /**
     * Get the spareType that owns the SparePart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function spareType(): BelongsTo
    {
        return $this->belongsTo(SpareType::class);
    }


    /**
     * Get the manufacturer that owns the SparePart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }
}
