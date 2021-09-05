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
            'first_name'=> $this->first_name,
            'last_name' => $this->last_name,
            'phone_number'=>$this->phone_number,
            'enrollment_number' => $this->enrollment_number,
            'user_id' => $this->user_id,
            'user' => $this->user,
            'created_at' => $this->created_at
        ];
    }
}