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
            'title' => 'unity基礎',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 'teacher2@example.com',
            'title' => 'php基礎',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-5',
            'updated_at' => '2025-4-5'
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 'teacher3@example.com',
            'title' => 'java応用',
            'year' => '2025',
            'session_flg' => '1',
            'created_at' => '2025-4-6',
            'updated_at' => '2025-4-6'
        ];
        DB::table('course_lists')->insert($param);
    }
}
