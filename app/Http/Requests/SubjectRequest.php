<?php

namespace App\Http\Requests;

use App\Models\Subject;
use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    public function uploadImage()
    {
        if ($this->hasFile('icon')) {
            $extension = $this->icon->extension();
            $this->icon->storeAs('/public/subject', str_replace(' ', '', $this->name) . "." . $extension);
            return str_replace(' ', '', $this->name) . "." . $extension;
        } else {
            return 'subject_default_.png';
        }
    }

    public function saveSubject()
    {
        $data = $this->validate([
            'name' => 'required|string',
            'level_id' => 'required'
        ]);
        $data['icon'] = $this->uploadImage();
        $subject = Subject::create($data);
        if ($subject) {
            return $subject;
        }
        return false;
    }

    public function updateSubject($subject)
    {
        $data = $this->validate([
            'name' => 'required',
            'level_id' => 'required',
        ]);
        $icon = "";
        if ($this->hasFile('icon')) {
            $icon = $this->uploadImage();
        } else {
            $icon = $subject->icon;
        }
        $subject->update([
            'name' => $data['name'],
            'level_id' => $data['level_id'],
            'icon' => $icon
        ]);
        return $subject;
    }
}
