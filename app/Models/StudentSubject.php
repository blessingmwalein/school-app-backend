<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
    use HasFactory;
    protected $guarded;



    protected $with =['student', 'subject'];
    public function student()
    {
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

    public function subject()
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }
}
