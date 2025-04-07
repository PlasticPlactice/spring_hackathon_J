<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'id' => 'admin@example.com',
            'pw' => Hash::make('admin'),  // パスワードをハッシュ化
            'del_flg' => '0',
            'created_at' => Carbon::now(),  // 現在の日時を設定
            'updated_at' => Carbon::now(),  // 現在の日時を設定
        ];
        DB::table('admins')->insert($param);
    }
}
