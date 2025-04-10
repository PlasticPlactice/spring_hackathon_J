<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\Auth\TeacherAuthController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminTimeTableController;
use App\Http\Controllers\MainSubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDataController;
use App\Http\Controllers\SubSubjectController;
use App\Http\Controllers\TeacherController;




// ログインページを表示
Route::get('/',[LoginController::class,'index'])->name('login');
// ログアウト処理
Route::get('/logout',[LoginController::class,'logout'])->name('logout');


// 管理者のログイン処理
Route::post('/admin_login',[AdminAuthController::class,'login']);
// 管理者のパスワード変更画面の表示
Route::get('/admin_password_change',[AdminAuthController::class,'passwordChangeShow']);
// 管理者パスワード変更処理
Route::post('/admin_password_change',[AdminAuthController::class,'passwordChange']);

// 教師ログイン処理
Route::post('/teacher_login',[TeacherAuthController::class,'login']);
// 教師データ登録ページを表示
Route::get('/teachers_register',[TeacherAuthController::class,'add']);
// 教師データ登録処理
Route::post('/teachers_add',[TeacherAuthController::class,'insert']);
// 教師データ編集・削除ページを表示
Route::get('/teacher_edit/{id}',[TeacherAuthController::class,'edit']);
// 教師データ編集処理
Route::post('/teacher_update/{id}',[TeacherAuthController::class,'update']);
// 教師データ削除処理
Route::post('/teacher_delete/{id}',[TeacherAuthController::class,'delete']);
// 教師のパスワード変更画面の表示
Route::get('/teacher_password_change',[TeacherAuthController::class,'passwordChangeShow']);
// 教師パスワード変更処理
Route::post('/teacher_password_change',[TeacherAuthController::class,'passwordChange']);

// ユーザのログイン処理を実行
Route::post('/student_login',[StudentAuthController::class,'login']);
// 生徒データ編集・削除ページを表示
Route::get('/student_edit/{id}',[StudentAuthController::class,'edit'])->name('student.edit');
// 生徒データ編集処理
Route::post('/student_update/{id}',[StudentAuthController::class,'update']);
// 生徒情報削除処理
Route::get('/student_delete/{id}',[StudentAuthController::class,'delete']);

// 生徒のパスワード変更画面の表示
Route::get('/student_password_change',[StudentAuthController::class,'passwordChangeShow']);
// 生徒のパスワード変更処理
Route::post('/student_password_change',[StudentAuthController::class,'passwordChange']);

// 管理者トップページを表示
Route::get('/admin_top',[AdminController::class,'index'])->name('admin.top');
// 教師データ一覧ページを表示
Route::get('/teachers_list',[AdminController::class,'teachersList']);

// 教師トップページを表示
Route::get('/teacher_top',[TeacherController::class,'index'])->name('teacher.top');

// 生徒トップページを表示
Route::get('/student_top',[StudentController::class,'index'])->name('student.top');
// 個別時間割作成ページを表示
Route::get('/personal_timetable_register',[StudentController::class,'addTimeTable']);
Route::post('/personal_timetable_register',[StudentController::class,'createTimeTable']);
// 個別時間割編集ページを表示
Route::get('/personal_timetable_edit',[StudentController::class,'editTimeTable']);

// 生徒データ一覧ページを表示
Route::get('/students_list',[StudentDataController::class,'index']);
// 生徒データ登録ページを表示
Route::get('/students_register',[StudentDataController::class,'add']);
// 生徒データ登録処理
Route::post('/students_add',[StudentDataController::class,'insert']);

// 科目マスタページ一覧を表示
Route::get('/subjects_master_list',[MainSubjectController::class,'index']);
// 科目マスタページを表示
Route::get('/subject_master',[MainSubjectController::class,'show']);
// 科目マスタページ登録ページを表示
Route::get('/subject_master_register',[MainSubjectController::class,'add']);
Route::post('/subject_master_register',[MainSubjectController::class,'create']);
// 科目マスタページ編集・削除ページを表示
Route::get('/subject_master_edit',[MainSubjectController::class,'edit']);
Route::post('/subject_master_edit',[MainSubjectController::class,'updateOrDelete']);

// 科目サブページを表示
Route::get('/subject_sub',[SubSubjectController::class,'index']);

// 管理者時間割ページを表示
Route::get('/timetable_register',[AdminTimeTableController::class,'index']);
// 今季履修科の科目登録ページを表示
Route::get('/available_subject_register',[AdminTimeTableController::class,'addTimeTable']);
// 今季履修科の科目編集・削除ページを表示
Route::get('/available_subject_edit',[AdminTimeTableController::class,'editTimeTable']);





// 一時的ローティング

Route::get('/kudou', function () {
    return view('parts.kudou');
});
Route::get('/kowada', function () {
    return view('parts.kowada');
});
Route::get('/shibaya', function () {
    return view('parts.shibaya');
});
