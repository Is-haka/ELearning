<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonType extends Model
{
    use HasFactory;

    // Table name (optional if it follows Laravel conventions)
    protected $table = 'lesson_types';

    // Fillable properties to allow mass assignment
    protected $fillable = [
        'reading',   // Path to the reading material (article file)
        'video',     // Path to the video file
        'lesson_id', // Foreign key to the lesson
        'created_at',
        'updated_at'
    ];

    /**
     * Get the lesson that owns this lesson type.
     */
    public function lesson()
    {
        return $this->belongsTo(Lessons::class, 'lesson_id', 'id');
    }
}
