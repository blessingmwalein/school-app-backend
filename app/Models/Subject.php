<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $guarded;

    // protected $with = ['level', 'teachers', ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'id');
    }

    public function teachers()
    {
       return $this->hasMany(TeacherSubjectClass::class, 'subject_id', 'id');
    }
    public function students()
    {
       return $this->hasMany(StudentSubject::class, 'subject_id', 'id');
    }
}
