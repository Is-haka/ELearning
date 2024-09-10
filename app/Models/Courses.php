<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
    public function users()
    {
        return $this->belongsToMany(User::class, 'enrollments')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function carts()
    {
        return $this->hasMany(Carts::class, 'course_id');
    }

    public function isInCart()
    {
        if (Auth::check()) {
            return Carts::where('course_id', $this->id)
                ->where('user_id', Auth::id())
                ->exists();
        }
        return false;
    }
}
