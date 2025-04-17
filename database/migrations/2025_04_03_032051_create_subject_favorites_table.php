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
        Schema::create('subject_favorites', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('y_subject_id');

            $table->primary(['student_id' , 'y_subject_id']);

            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('y_subject_id')->references('course_list_id')->on('y_subjects');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_favorites');
    }
};
