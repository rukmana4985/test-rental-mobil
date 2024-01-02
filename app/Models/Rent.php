<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $fillable = ['date_start','date_end', 'car_id','status', 'price', 'lama_sewa'];

    public function car()
    {
        return $this->belongsTo('App\Models\Car', 'car_id');
        
    }
    
    
}
