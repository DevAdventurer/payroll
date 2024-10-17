<?php

namespace App\Http\Resources\Admin\Fees;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FeesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'data' => FeesResource::collection($this->collection),
            'recordsTotal' => $this->totalRecords,  // Total number of records
            'recordsFiltered' => $this->totalRecords,  // Total after filtering (same as total if no filtering)
            'draw' => $request->input('draw'),  // Required for DataTables to keep track of requests
        ];
    }
}
