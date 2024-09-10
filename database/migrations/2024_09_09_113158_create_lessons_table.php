<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->unsignedBigInteger('course_id'); // Foreign key for the course
            $table->string('title'); // Title of the lesson
            $table->integer('duration'); // Duration of the lesson in minutes or seconds
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraint
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
