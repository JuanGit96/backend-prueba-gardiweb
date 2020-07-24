<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        "role_name"
    ];

    public function users()
    {
        return $this->hasyMany(User::class);
    }
}
