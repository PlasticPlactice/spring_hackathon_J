<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubSubjectController extends Controller
{
    // 科目サブページを表示
    public function index(Request $request){
        return view('subject/subject_sub');
    }

    public function create(Request $request) {
        $params = [
            'course_list_id' => $request->course_list_id,
            'subject_id' => $request->subject_id,
            'detail' => $request->detail
        ];

        DB::table('y_subjects')->insert($params);

        return view('subject/');
    }
}
