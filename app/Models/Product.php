<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'image',
        'category_id',
        'manufacturer_id',
    ];

    /**
     * Get the accessoryType that owns the Accessory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accessoryType(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    /**
     * Get the manufacturer that owns the Accessory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function scopeSearch($query, string|null $term)
    {
        if ($term) {
            $term = "%$term%";
            $query->where('name', 'LIKE', $term);
        }
    }
}
