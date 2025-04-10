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
            'teacher_id' => 1,
            'title' => 'java基礎',
            'year' => '2025',
            'session_flg' => '0',
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 2,
            'title' => 'php基礎',
            'year' => '2025',
            'session_flg' => '0',
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 3,
            'title' => 'java応用',
            'year' => '2025',
            'session_flg' => '1',
        ];
        DB::table('course_lists')->insert($param);
    }
}
