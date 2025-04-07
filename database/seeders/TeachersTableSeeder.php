<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'id' => 'teacher1@example.com',
            'pw' => 'teacher1',
            'name' => '金野本戸',
            'del_flg' => '0'
        ];
        DB::table('teachers')->insert($param);
        
        $param = [
            'id' => 'teacher2@example.com',
            'pw' => 'teacher2',
            'name' => '高田舞',
            'del_flg' => '0'
        ];
        DB::table('teachers')->insert($param);
        
        $param = [
            'id' => 'teacher3@example.com',
            'pw' => 'teacher3',
            'name' => '高橋博人',
            'del_flg' => '0'
        ];
        DB::table('teachers')->insert($param);
    }
}
