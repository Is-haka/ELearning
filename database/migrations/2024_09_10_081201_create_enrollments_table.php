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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->bigIncrements('id');                           // Primary Key
            $table->foreignId('user_id')            // Foreign key to users table
                  ->constrained('users')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('course_id')          // Foreign key to courses table
                  ->constrained('courses')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status', ['enrolled', 'not enrolled', 'completed', 'cancelled']) // Enrollment status
                  ->default('not enrolled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
