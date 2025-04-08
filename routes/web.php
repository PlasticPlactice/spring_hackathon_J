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
Route::get('/',[LoginController::class,'index']);

// 管理者のパスワード変更画面の表示
Route::get('/admin_password_change',[AdminAuthController::class,'passwordChange']);

// 教師データ登録ページを表示
Route::get('/teachers_register',[TeacherAuthController::class,'add']);
// 教師データ編集・削除ページを表示
Route::get('/teachers_edit',[TeacherAuthController::class,'edit']);
// 教師のパスワード変更画面の表示
Route::get('/teacher_password_change',[TeacherAuthController::class,'passwordChange']);

// 生徒データ編集・削除ページを表示
Route::get('/students_edit',[StudentAuthController::class,'edit']);
// 生徒のパスワード変更画面の表示
Route::get('/student_password_change',[StudentAuthController::class,'passwordChange']);

// 管理者トップページを表示
Route::get('/admin_top',[AdminController::class,'index']);
// 教師データ一覧ページを表示
Route::get('/teachers_list',[AdminController::class,'teachersList']);

// 教師トップページを表示
Route::get('/teacher_top',[TeacherController::class,'index']);

// 生徒トップページを表示
Route::get('/student_top',[StudentController::class,'index']);
// 個別時間割作成ページを表示
Route::get('/personal_timetable_register',[StudentController::class,'addTimeTable']);
// 個別時間割編集ページを表示
Route::get('/personal_timetable_edit',[StudentController::class,'editTimeTable']);

// 生徒データ一覧ページを表示
Route::get('/students_list',[StudentDataController::class,'index']);
// 生徒データ登録ページを表示
Route::get('/students_register',[StudentDataController::class,'add']);

// 科目マスタページ一覧を表示
Route::get('/subjects_master_list',[MainSubjectController::class,'index']);
// 科目マスタページを表示
Route::get('/subject_master',[MainSubjectController::class,'show']);
// 科目マスタページ登録ページを表示
Route::get('/subject_master_register',[MainSubjectController::class,'add']);
// 科目マスターページ登録してもどる
Route::post('/subject_master_register', [MainSubjectController::class, 'create']);
// 科目マスタページ編集・削除ページを表示
Route::get('/subject_master_edit',[MainSubjectController::class,'edit']);
// 科目マスターページ更新または削除の処理
Route::post('/subject_master_edit', [MainSubjectController::class,'updateOrDelete']);

// 科目サブページを表示
Route::get('/subject_sub',[SubSubjectController::class,'index']);

// 管理者時間割ページを表示
Route::get('/timetable_register',[AdminTimeTableController::class,'index']);
// 今季履修可能科目登録ページを表示
Route::get('/available_subject_register',[AdminTimeTableController::class,'addTimeTable']);
// 今期履修可能科目登録
Route::post('/available_subject_register',[AdminTimeTableController::class,'createTimeTable']);

// 今季履修可能科目編集・削除ページを表示
Route::get('/available_subject_edit',[AdminTimeTableController::class,'editTimeTable']);
// 今期履修可能科目編集処理
Route::post('/available_subject_edit',[AdminTimeTableController::class,'updateOrdeleteTimeTable']);





// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
