<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\ClassLike;

class TeacherSubjectClass extends Model
{
    use HasFactory;

    protected $guarded;

    protected $with = ['teacher', 'subject','classe'];

    public function teacher()
    {
        return $this->hasOne(Teacher::class,'id', 'teacher_id');
    }
    public function subject()
    {
        return $this->hasOne(Subject::class,'id', 'subject_id');
    }
    public function classe()
    {
        return $this->hasOne(ClassLevel::class,'id', 'class_id');
    }

}
