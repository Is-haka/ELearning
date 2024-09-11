<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'user_id',
        'quantity',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function courses() {
        return $this->belongsTo(Courses::class, 'course_id');
    }
}
