<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded;

    protected $with =['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjects()
    {
        return $this->hasMany(StudentSubject::class);
    }

    public function classe()
    {
       return $this->hasMany(StudentClass::class);
    }

    public function home()
    {
        return $this->hasMany(StudentHome::class);
    }
}
