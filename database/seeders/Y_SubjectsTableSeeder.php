<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Y_SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'course_list_id' => '2',
            'subject_id' => '6',
            'detail' => 'php基礎のサブページです。',
        ];
        DB::table('y_subjects')->insert($param);
        $param = [
            'course_list_id' => '1',
            'subject_id' => '4',
            'detail' => 'unity基礎のサブページ',
        ];
        DB::table('y_subjects')->insert($param);
        $param = [
            'course_list_id' => '3',
            'subject_id' => '5',
            'detail' => 'Java応用(JavaFX)のサブページです',
        ];
        DB::table('y_subjects')->insert($param);
    }
}
