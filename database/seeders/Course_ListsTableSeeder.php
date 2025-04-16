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
            'teacher_id' => 3,
            'title' => 'Unity基礎',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 1,
            'title' => 'PHP基礎',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 3,
            'title' => 'Java応用(JavaFX)',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);





        $param = [
            'teacher_id' => 1,
            'title' => 'java基礎A',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 1,
            'title' => 'java基礎B',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 1,
            'title' => 'Python基礎A',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 1,
            'title' => 'Python基礎B',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);
     
        $param = [
            'teacher_id' => 1,
            'title' => 'ITパスポート対策',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 1,
            'title' => '基本情報科目B対策',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 2,
            'title' => '応用情報対策(午後試験)',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 2,
            'title' => '高度情報対策',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 2,
            'title' => 'AIリテラシー',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 2,
            'title' => 'ストラテジ・マネジメント',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 3,
            'title' => 'テクノロジ',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 3,
            'title' => 'Python応用(Django)',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 3,
            'title' => 'システム開発演習',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);

        $param = [
            'teacher_id' => 3,
            'title' => '応用情報午前対策',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);



        $param = [
            'teacher_id' => 2,
            'title' => '応用情報対策(午前試験)',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);
 
        $param = [
            'teacher_id' => 3,
            'title' => 'Scratch基礎',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);
        $param = [
            'teacher_id' => 3,
            'title' => 'テスト基礎',
            'year' => '2025',
            'session_flg' => '0',
            'created_at' => '2025-4-4',
            'updated_at' => '2025-4-4'
        ];
        DB::table('course_lists')->insert($param);
     
        
        


        
    }
}
