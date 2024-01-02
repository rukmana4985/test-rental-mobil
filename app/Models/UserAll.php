<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class UserAll extends Model
{
    protected $table = 'users';
    protected $fillable = ['username','role_id', 'password', 'address', 'sim', 'phone'];



    public function role(){
        return $this->belongsTo('App\Models\Role', 'role_id');
    }

    public function car(){
        return $this->hasMany('App\Models\Car', 'id', 'user_id');
    }
    
}   
