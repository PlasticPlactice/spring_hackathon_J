<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class S_CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'subject_id' => '1',
            'student_id' => '1',
            'title' => '最高',
            'detail' => '神教師',
            'Created_at' => Carbon::now(),
            'Updated_at' => Carbon::now()
        ];
        DB::table('s_comments')->insert($param);
        $param = [
            'subject_id' => '1',
            'student_id' => '2',
            'title' => '最悪',
            'detail' => '最悪の教科',
            'Created_at' => Carbon::now(),
            'Updated_at' => Carbon::now()
        ];
        DB::table('s_comments')->insert($param);
        $param = [
            'subject_id' => '1',
            'student_id' => '3',
            'title' => 'ゴミ',
            'detail' => '絶対落単おつ',
            'Created_at' => Carbon::now(),
            'Updated_at' => Carbon::now()
        ];
        DB::table('s_comments')->insert($param);
    }
}
