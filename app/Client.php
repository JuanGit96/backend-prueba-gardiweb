<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        "name",
        "lastname",
        "identification_number",
        "image_profile",
        "residence_address",
        "birth_date",
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
