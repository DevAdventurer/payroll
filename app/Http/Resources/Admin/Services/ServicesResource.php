<?php

namespace App\Http\Resources\Admin\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServicesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function status($status)
    {
        if ($status == 'active') {
            $status = '<span class="badge badge-soft-success">Active</span>';
        } elseif ($status == 'inactive') {
            $status = '<span class="badge badge-soft-success">Password Not Set</span>';
        } else{
            $status = '<span class="badge badge-soft-success">Deactivated</span>';
        }
        return $status;
    }
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'sn' => ++$request->start,
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status($this->status),
        ];
    }
}
