<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;
    protected $guarded;

    protected $with =['classe'];

    public function student()
    {
        return $this->hasOne(Student::class,'id','student_id' );
    }

    public function classe()
    {
        return $this->hasOne(ClassLevel::class,'id','class_id' );
    }
}
