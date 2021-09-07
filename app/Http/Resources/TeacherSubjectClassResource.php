<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherSubjectClassResource extends JsonResource
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
            'id'=> $this->id,
            'classes'=>new ClassLevelResource($this->classe),
            'teacher' => new TeacherResource($this->teacher),
            'subject' => new SubjectResource($this->subject)
        ];
    }
}
