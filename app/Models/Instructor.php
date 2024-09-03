<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $table = 'instructor';

    public function courses()
    {
        return $this->hasMany(Courses::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id'); // Assuming 'user_id' is the foreign key in 'instructor' table
    }
}
