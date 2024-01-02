<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $fillable = ['car_id','payment_date'];


    public function car()
    {
        return $this->belongsTo('App\Models\Car','car_id');
    }
}
