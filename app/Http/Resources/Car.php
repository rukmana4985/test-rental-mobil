<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;



class Car extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->code,
            'plat' => $this->plat,
            'merk' => $this->merk,
            'model' => $this->model,
            'tarif'=> $this->tarif,
            'status'=> $this->status
        ];
    }
}
