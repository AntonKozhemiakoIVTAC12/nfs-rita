<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    use HasFactory;

    protected $primaryKey = 'lesson_id';
    protected $fillable = [
        'lesson_date',
        'lesson_time',
        'teacher_id',
        'subject_id',
        'type_id',
        'group_id',
        'status'
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function lessonType(): BelongsTo
    {
        return $this->belongsTo(LessonType::class, 'type_id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class, 'lesson_id');
    }
}
