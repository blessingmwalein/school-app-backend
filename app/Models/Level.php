<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    // protected $guarded;
    use HasFactory;

    protected $fillable =['name'];

    public function classes()
    {
        return $this->hasMany(ClassLevel::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
