<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
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
            'first_name'=> $this->first_name,
            'last_name' => $this->last_name,
            'phone_number'=>$this->phone_number,
            'teacher_number' => $this->teacher_number,
            'user_id' => $this->user_id,
            'user' => $this->user,
            'created_at' => $this->created_at,
            'subjects' => $this->subjects
        ];
    }
}
