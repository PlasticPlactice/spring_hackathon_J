<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon; 

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'pw' => Hash::make('student1'),
            'email' => 'student1@example.com',
            'name' => '田中太郎',
            'del_flg' => '0',
            'img_path' => '',
            'entrance_year' => '2023',
            'department_id' => '1',
            'created_at' => Carbon::now(),  // 現在の日時を設定
            'updated_at' => Carbon::now(),  // 現在の日時を設定
            
        ];
        DB::table('students')->insert($param);
        $param = [
            'pw' => Hash::make('student3'),
            'email' => 'student2@example.com',
            'name' => '今野拓郎',
            'del_flg' => '0',
            'img_path' => '',
            'entrance_year' => '2024',
            'department_id' => '2',
            'created_at' => Carbon::now(),  // 現在の日時を設定
            'updated_at' => Carbon::now(),  // 現在の日時を設定
        ];
        DB::table('students')->insert($param);
        $param = [
            'pw' => Hash::make('student3'),
            'email' => 'student3@example.com',
            'name' => '高橋花子',
            'del_flg' => '0',
            'img_path' => '',
            'entrance_year' => '2025',
            'department_id' => '3',
            'created_at' => Carbon::now(),  // 現在の日時を設定
            'updated_at' => Carbon::now(),  // 現在の日時を設定
        ];
        DB::table('students')->insert($param);
    }
}
