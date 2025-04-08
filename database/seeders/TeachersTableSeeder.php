<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1件目の教師データ
        $param = [
            'id' => 'teacher1@example.com',
            'pw' => Hash::make('teacher1'),  // パスワードをハッシュ化
            'name' => '金野本戸',
            'del_flg' => '0',
            'created_at' => Carbon::now(),  // 現在の日時を設定
            'updated_at' => Carbon::now(),  // 現在の日時を設定
        ];
        DB::table('teachers')->insert($param);
        
        // 2件目の教師データ
        $param = [
            'id' => 'teacher2@example.com',
            'pw' => Hash::make('teacher2'),  // パスワードをハッシュ化
            'name' => '高田舞',
            'del_flg' => '0',
            'created_at' => Carbon::now(),  // 現在の日時を設定
            'updated_at' => Carbon::now(),  // 現在の日時を設定
        ];
        DB::table('teachers')->insert($param);
        
        // 3件目の教師データ
        $param = [
            'id' => 'teacher3@example.com',
            'pw' => Hash::make('teacher3'),  // パスワードをハッシュ化
            'name' => '高橋博人',
            'del_flg' => '0',
            'created_at' => Carbon::now(),  // 現在の日時を設定
            'updated_at' => Carbon::now(),  // 現在の日時を設定
        ];
        DB::table('teachers')->insert($param);
    }
}
