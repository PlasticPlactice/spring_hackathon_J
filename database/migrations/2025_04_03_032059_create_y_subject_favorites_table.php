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
        Schema::create('y_subject_favorites', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('y_subject_id');

            $table->primary(['teacher_id' , 'y_subject_id']);
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('y_subject_id')->references('course_list_id')->on('y_subjects');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('y_subject_favorites');
    }
};
