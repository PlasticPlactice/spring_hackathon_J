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
        Schema::create('t_comments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('y_subject_id');
            $table->uuid('teacher_id');
            $table->foreign('y_subject_id')->references('course_list_id')->on('y_subjects');
            $table->foreign('teacher_id')->references('id')->on('teachers');

            $table->string('title');
            $table->string('detail');
            $table->boolean('link_flg')->default(false);
            $table->boolean('del_flg')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_comments');
    }
};
