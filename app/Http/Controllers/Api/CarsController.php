<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Car;

use App\Http\Resources\Car as CarResource;

class CarsController extends Controller
{
    public function show ($id)
    {
        return new CarResource(Car::find($id));
    }
}
