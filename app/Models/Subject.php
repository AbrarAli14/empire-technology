<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'teacher_student', 'subject_id', 'teacher_id');
    }}
