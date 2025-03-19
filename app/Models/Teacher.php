<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password'];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subjects');
    }
}
