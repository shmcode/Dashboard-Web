<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'birthdate',
        'city_id',
        'address',
        'phone',
    ];

    public function city(){
        return $this->belongsTo(City::class);
    }

}
