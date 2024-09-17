<?php

namespace App\Http\Resources\Admin\FileManager;

use Illuminate\Http\Resources\Json\JsonResource;
class FileManagerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'sn' => ++$request->start,
            'id'=>$this->id,
            'original_name'=>$this->original_name, 
            'name'=>$this->name, 'size'=>$this->size, 
            'type'=>$this->type,
            'file'=>$this->file?'<img class="rounded img-thumbnail avatar-img avatar-sm" src="'.asset($this->file).'">':'N/A'
        ];
    }
}
