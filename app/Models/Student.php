<?php

namespace App\Models;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'user_id','password'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
    public function grades()
{
    return $this->hasMany(Grade::class);
}
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_student', 'student_id', 'subject_id');
    }
    
}
