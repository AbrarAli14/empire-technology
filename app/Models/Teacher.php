<?php

namespace App\Models;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'password','user_id'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

   
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher', 'teacher_id', 'subject_id');
    }
}
