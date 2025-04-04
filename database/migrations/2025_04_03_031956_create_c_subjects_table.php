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
        Schema::create('c_subjects', function (Blueprint $table) {
            $table->string('student_id');
            $table->unsignedBigInteger('course_list_id');

            $table->primary(['student_id', 'course_list_id']);

            $table->foreign('student_id')->references('id')->on('students');

            $table->foreign('course_list_id')->references('id')->on('course_lists');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_subjects');
    }
};
