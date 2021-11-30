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
        'type_id',
        'car_details_id',
        'thumb_nail',
        'user_id',
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
     * Get the type that owns the Car
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
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
