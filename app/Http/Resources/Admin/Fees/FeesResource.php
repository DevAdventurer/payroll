<?php

namespace App\Http\Resources\Admin\Fees;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function status($status)
    {
        if ($status == '1') {
            $status = '<span class="badge badge-soft-success">Active</span>';
        } elseif ($status == 0) {
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
           
            'company_name' => $this->name,
            
            'status' => $this->status($this->status),
        ];
    }
}
