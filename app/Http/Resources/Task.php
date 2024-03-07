<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Task extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>(int)$this->id,
            'title'=>(string)$this->title,
            'description'=>(string)$this->description,
            'status'=>(string)$this->getStatus(),
            'status_int'=>(int)$this->status,
            'created'=> date_format($this->created_at,"d-m-Y H:i:s")
        ];
    }
}
