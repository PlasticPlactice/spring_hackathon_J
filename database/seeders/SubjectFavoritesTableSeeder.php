<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class subjectFavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'student_id' => '1',
            'y_subject_id' => '1'
        ];
        DB::table('subject_favorites')->insert($param);
        $param = [
            'student_id' => '1',
            'y_subject_id' => '2'
        ];
        DB::table('subject_favorites')->insert($param);
        $param = [
            'student_id' => '1',
            'y_subject_id' => '3'
        ];
        DB::table('subject_favorites')->insert($param);
    }
}
