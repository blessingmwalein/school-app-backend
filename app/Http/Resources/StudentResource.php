<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'enrollment_number' => $this->enrollment_number,
            'user_id' => $this->user_id,
            'user' => $this->user,
            'subjects'=> StudentSubjectResource::collection($this->subjects),
            'classe'=> $this->classe,
            'home'=>$this->home,
            'created_at' => $this->created_at
        ];
    }
}
