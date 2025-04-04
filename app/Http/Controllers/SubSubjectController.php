<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubSubjectController extends Controller
{
    // 科目サブページを表示
    public function index(Request $request){
        return view('subject/subject_sub');
    }
}
