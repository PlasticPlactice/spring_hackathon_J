<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'pw' => 'student1',
            'name' => '田中太郎',
            'del_flg' => '0',
            'img_path' => '',
            'entrance_year' => '2023',
            'department_id' => '1'
        ];
        DB::table('students')->insert($param);
        $param = [
            'pw' => 'student2',
            'name' => '今野拓郎',
            'del_flg' => '0',
            'img_path' => '',
            'entrance_year' => '2024',
            'department_id' => '2'
        ];
        DB::table('students')->insert($param);
        $param = [
            'pw' => 'student3',
            'name' => '高橋花子',
            'del_flg' => '0',
            'img_path' => '',
            'entrance_year' => '2025',
            'department_id' => '3'
        ];
        DB::table('students')->insert($param);
    }
}
