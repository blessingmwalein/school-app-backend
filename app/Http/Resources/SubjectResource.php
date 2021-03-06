<?php

namespace App\Http\Resources;

use App\Models\StudentSubject;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'level_id' =>$this->level_id,
            'level' => $this->level,
            'teachers'=> $this->teachers,
            'students'=> $this->students,
            'icon' => $this->icon,
            'created_at' => $this->created_at
        ];
    }
}
