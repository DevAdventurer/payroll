<?php

namespace App\Http\Resources\Admin\Client;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
class ClientResource extends JsonResource
{
    function balance($amount){
        if($amount > 0){
            return '<span class="text-danger">'.price($amount).'</span>';
        }

        return '<span class="text-muted">'.price($amount).'</span>';
    }

    public function toArray($request)
    {
        return [
            'sn' => ++$request->start,
            'id' => $this->id,
            'name' => userName($this->id),
            'email' => $this->email,
            'mobile' => $this->mobile,
            'city' => $this->city->name,
            'status' => status($this->status_id),
        ];
    }
}
