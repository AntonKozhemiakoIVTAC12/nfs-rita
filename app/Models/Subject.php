<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    use HasFactory;

    protected $primaryKey = 'subject_id';
    protected $fillable = ['subject_name', 'code'];

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(
            Teacher::class,
            'teacher_subjects',
            'subject_id',
            'teacher_id'
        );
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'subject_id');
    }
}
