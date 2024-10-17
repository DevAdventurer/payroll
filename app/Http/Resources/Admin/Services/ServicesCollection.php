<?php

namespace App\Http\Resources\Admin\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ServicesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    protected $totalRecords;

    // Add a constructor to accept the total records
    public function __construct($resource, $totalRecords)
    {
        parent::__construct($resource);
        $this->totalRecords = $totalRecords;
    }
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'data' => ServicesResource::collection($this->collection),
            'recordsTotal' => $this->totalRecords,  // Total number of records
            'recordsFiltered' => $this->totalRecords,  // Total after filtering (same as total if no filtering)
            'draw' => $request->input('draw'),  // Required for DataTables to keep track of requests
        ];
    }
}
