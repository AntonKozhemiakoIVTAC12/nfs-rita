<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonType extends Model
{
    use HasFactory;

    protected $primaryKey = 'type_id';
    protected $fillable = ['type_name'];
    public $timestamps = false;
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'type_id');
    }
}
