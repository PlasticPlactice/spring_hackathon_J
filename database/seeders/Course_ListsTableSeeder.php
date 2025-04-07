<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Course_ListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'teacher_id' => 'teacher1@example.com',
            'title' => 'java基礎',
            'year' => '2025',
            'session_flg' => '0',
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 'teacher2@example.com',
            'title' => 'php基礎',
            'year' => '2025',
            'session_flg' => '0',
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 'teacher3@example.com',
            'title' => 'java応用',
            'year' => '2025',
            'session_flg' => '1',
        ];
        DB::table('course_lists')->insert($param);
    }
}
