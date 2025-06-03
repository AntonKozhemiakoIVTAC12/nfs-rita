<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;

    protected $primaryKey = 'group_id';
    protected $fillable = ['group_name', 'course'];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            Student::class,
            'student_groups',
            'group_id',
            'student_id'
        );
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'group_id');
    }
}
