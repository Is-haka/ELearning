<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $table = 'courses';

    public function categories() {
        return $this->belongsTo(Categories::class, 'categories_id');
    }

    public function instructor() {
        return $this->belongsTo(Instructor::class, 'instructor_id'); // Adjust the foreign key as needed
    }
}
