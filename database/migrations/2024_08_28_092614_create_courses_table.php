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
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->enum('modeOfDelivery', ['remote', 'physical'])->default('remote');
            $table->enum('deliveryLocation', ['ATC Main Campus', 'Remote (Online)', 'ATC Kikuletwa'])->default('remote (Online)');
            $table->enum('entryQualification', ['']);
            $table->integer('trend')->default(0);
            $table->string('language');
            $table->string('thumbnail')->nullable();
            $table->timestamps();


            // Foreign key to categories table
            $table->foreignId('categories_id')->constrained('categories')->onDelete('cascade')->onUpdate('cascade');
            // Foreign key to instructors table
            $table->foreignId('instructor_id')->constrained('instructor')->onDelete('cascade')->onUpdate('cascade');
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
