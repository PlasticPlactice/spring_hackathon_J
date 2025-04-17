<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Y_Subjects_FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'teacher_id' => '1',
            'y_subject_id' => '1'
        ];
        DB::table('y_subject_favorites')->insert($param);
        $param = [
            'teacher_id' => '1',
            'y_subject_id' => '2'
        ];
        DB::table('y_subject_favorites')->insert($param);
        $param = [
            'teacher_id' => '1',
            'y_subject_id' => '3'
        ];
        DB::table('y_subject_favorites')->insert($param);
    }
}
