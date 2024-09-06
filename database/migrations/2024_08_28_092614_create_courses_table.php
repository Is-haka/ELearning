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
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');

            // Foreign key to instructors table
            $table->foreignId('instructor_id')
                  ->constrained('instructor')
                  ->onDelete('cascade');  // Automatically delete course if instructor is deleted

            $table->string('title');
            $table->text('description');
            $table->decimal('price', 8, 2);

            // Foreign key to categories table
            $table->foreignId('categories_id')
                  ->constrained('categories')
                  ->onDelete('cascade');  // Automatically delete course if category is deleted

            $table->string('language');
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
