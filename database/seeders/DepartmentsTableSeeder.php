<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'name' => '高度情報工学科'
        ];
        DB::table('departments')->insert($param);
        
        $param = [
            'name' => '総合システム工学科'
        ];
        DB::table('departments')->insert($param);
        
        $param = [
            'name' => '情報システム科'
        ];
        DB::table('departments')->insert($param);
        
        $param = [
            'name' => '情報ビジネス科'
        ];
        DB::table('departments')->insert($param);
    }
}
