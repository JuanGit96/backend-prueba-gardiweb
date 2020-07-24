<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        "model",
        "plate",
        "color",
        "image",
        "brand_id",
        "client_id",
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
     protected $with = [
        'brand', 'client'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
