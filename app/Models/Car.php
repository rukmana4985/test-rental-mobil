<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class Car extends Model
{
    protected $fillable = ['plat','merk', 'model', 'tarif', 'user_id', 'status'];


    public function user()
    {
        return $this->belongsTo('App\Models\UserAll', 'user_id');
        
    }

    public function rents()
    {
        return $this->hasMany('App\Models\Rent', 'car_id', 'id');
    }
    
}
