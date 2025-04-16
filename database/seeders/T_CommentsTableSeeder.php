<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class T_CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'y_subject_id' => '1',
            'teacher_id' => '1',
            'title' => '課題について',
            'detail' => '4/1までに提出してください',
            'link_flg' => '0',
            'del_flg' => '0',
            'Created_at' => Carbon::now(),
            'Updated_at' => Carbon::now()

        ];
        DB::table('t_comments')->insert($param);
        $param = [
            'y_subject_id' => '1',
            'teacher_id' => '1',
            'title' => '4/10について',
            'detail' => '4/10は休講にします',
            'link_flg' => '0',
            'del_flg' => '1',
            'Created_at' => Carbon::now(),
            'Updated_at' => Carbon::now()
        ];
        DB::table('t_comments')->insert($param);
    }
}
