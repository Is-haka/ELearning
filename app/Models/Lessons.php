<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lessons extends Model
{
    use HasFactory;

    // Table name (optional if it follows Laravel conventions)
    protected $table = 'lessons';

    // Fillable properties to allow mass assignment
    protected $fillable = [
        'name',          // Name of the lesson
        'description',   // Description of the lesson
        'duration',      // Duration of the lesson (optional)
        'created_at',    // Timestamp of creation
        'updated_at'     // Timestamp of last update
    ];

    /**
     * Get the lesson types associated with the lesson.
     */
    public function lessonTypes()
    {
        return $this->hasMany(LessonType::class, 'lesson_id', 'id');
    }
}
