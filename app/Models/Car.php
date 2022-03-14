<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'model',
        'manufacturer_id',
        'category_id',
        'car_details_id',
        'thumb_nail',
        'images',
        'action',
        'user_id',
    ];
    protected $casts = [
        'images' => 'array'
    ];


    /**
     * Get the details associated with the Car
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function details(): HasOne
    {
        return $this->hasOne(CarDetails::class);
    }

    /**
     * Get the manufacturer that owns the Car
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    /**
     * Get the category that owns the Car
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeSearch($query, $term)
    {
        if ($term) {
            $term = "%$term%";
            $query->where(function ($query) use ($term) {
                $query->where('model', 'LIKE', $term)->orWhereHas('manufacturer', function (Builder $query) use ($term) {
                    $query->where('manufacturers.name', 'LIKE', $term)
                        ->orWhereRaw(
                            "CONCAT(manufacturers.`name`, ' ', `model`) LIKE ?",
                            [$term]
                        )->orWhereRaw(
                            "CONCAT(`model`, ' ',manufacturers.`name`) LIKE ?",
                            [$term]
                        );
                });
            });
        }
    }

    /**
     * Get the user that owns the Car
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
