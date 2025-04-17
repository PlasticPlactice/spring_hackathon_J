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

Route::middleware(['web'])->group(function () {

    


// ログインページを表示
Route::get('/',[LoginController::class,'index'])->name('login');
// ログアウト処理
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

// 画像専用のルート
// Route::get('images/{filename}', [ImageController::class, 'show'])
//     ->name('images.show')
//     ->withoutMiddleware('auth'); // 認証ミドルウェアを無効化


// 管理者のログイン処理
Route::post('/admin_login',[AdminAuthController::class,'login']);
// 管理者のパスワード変更画面の表示
Route::get('/admin_password_change',[AdminAuthController::class,'passwordChangeShow'])->middleware('admin');
// 管理者パスワード変更処理
Route::post('/admin_password_change',[AdminAuthController::class,'passwordChange'])->middleware('admin');;

// 教師ログイン処理
Route::post('/teacher_login',[TeacherAuthController::class,'login']);
// 教師データ登録ページを表示
Route::get('/teachers_register',[TeacherAuthController::class,'add'])->middleware('admin');;
// 教師データ登録処理
Route::post('/teachers_add',[TeacherAuthController::class,'insert'])->middleware('admin');;
// 教師データ編集・削除ページを表示
Route::get('/teacher_edit/{id}',[TeacherAuthController::class,'edit'])->middleware('admin');;
// 教師データ編集処理
Route::post('/teacher_update/{id}',[TeacherAuthController::class,'update'])->middleware('admin');;
// 教師データ削除処理
Route::get('/teacher_delete/{id}',[TeacherAuthController::class,'delete'])->middleware('admin');;
// 教師のパスワード変更画面の表示
Route::get('/teacher_password_change',[TeacherAuthController::class,'passwordChangeShow'])->middleware('teacher');;
// 教師パスワード変更処理
Route::post('/teacher_password_change',[TeacherAuthController::class,'passwordChange'])->middleware('teacher');

// ユーザのログイン処理を実行
Route::post('/student_login',[StudentAuthController::class,'login']);
// 生徒データ編集・削除ページを表示
Route::get('/student_edit/{id}',[StudentAuthController::class,'edit'])->middleware('teacher_or_admin')->name('student.edit');
// 生徒データ編集処理
Route::post('/student_update/{id}',[StudentAuthController::class,'update'])->middleware('teacher_or_admin');
// 生徒情報削除処理
Route::get('/student_delete/{id}',[StudentAuthController::class,'delete'])->middleware('teacher_or_admin');

// 生徒のパスワード変更画面の表示
Route::get('/student_password_change',[StudentAuthController::class,'passwordChangeShow'])->middleware('student');
// 生徒のパスワード変更処理
Route::post('/student_password_change',[StudentAuthController::class,'passwordChange'])->middleware('student');

// 管理者トップページを表示
Route::get('/admin_top',[AdminController::class,'index'])->name('admin.top')->middleware('admin');
// 教師データ一覧ページを表示
Route::get('/teachers_list',[AdminController::class,'teachersList'])->middleware('admin')->name('teacher-list');

// 教師トップページを表示
Route::get('/teacher_top',[TeacherController::class,'index'])->name('teacher.top')->middleware('teacher');

// 生徒トップページを表示
Route::get('/student_top',[StudentController::class,'index'])->name('student.top')->middleware('student');
// 個別時間割作成ページを表示
Route::get('/personal_timetable_register',[StudentController::class,'addTimeTable'])->middleware('student');
// 個人時間割登録処理
Route::post('/personal_timetable_register',[StudentController::class,'insertTimeTable'])->middleware('student');
// 個別時間割編集ページを表示
Route::get('/personal_timetable_edit',[StudentController::class,'editTimeTable'])->middleware('student');
// 個別時間割編集処理
Route::post('/personal_timetable_edit',[StudentController::class,'updateTimeTable'])->middleware('student');

// 生徒データ一覧ページを表示
Route::get('/students_list',[StudentDataController::class,'index'])->middleware('teacher_or_admin');
// 生徒データ登録ページを表示
Route::get('/students_register',[StudentDataController::class,'add'])->middleware('teacher_or_admin');
// 生徒データ登録処理
Route::post('/students_add',[StudentDataController::class,'insert'])->middleware('teacher_or_admin');

// 科目マスタページ一覧を表示
Route::get('/subjects_master_list',[MainSubjectController::class,'index'])->middleware('all');
Route::get('/subjects_master_list_search',[MainSubjectController::class,'search'])->middleware('all');
// 科目マスタページを表示
Route::get('/subject_master/{id}',[MainSubjectController::class,'show'])->middleware('all');
// コメント登録処理
Route::post('/subject_master',[MainSubjectController::class, 'createComment'])->middleware('student');
// 科目マスタページ登録ページを表示
Route::get('/subject_master_register',[MainSubjectController::class,'add'])->middleware('admin');
Route::post('/subject_master_register',[MainSubjectController::class,'create'])->middleware('admin');
// 科目マスタページ編集・削除ページを表示
Route::get('/subject_master_edit/{id}',[MainSubjectController::class,'edit'])->middleware('admin');
Route::post('/subject_master_edit',[MainSubjectController::class,'updateOrDelete'])->middleware('admin');

// 科目サブページを表示
Route::get('/subject_sub/{course_list_id}',[SubSubjectController::class,'index'])->middleware('all');
// 教師のコメントを投稿

Route::post('/subject_sub',[SubSubjectController::class,'createTComment'])->middleware('teacher');
Route::delete('subject_sub/{id}', [SubSubjectController::class, 'deleteTComment'])->name('comment.delete')->middleware('teacher');

// 管理者時間割ページを表示
Route::get('/timetable_register',[AdminTimeTableController::class,'index'])->middleware('admin');
// 今季の時間割を登録する処理
Route::post('/timetable_add',[AdminTimeTableController::class,'insert'])->middleware('admin');

// 今季履修科の科目登録ページを表示
Route::get('/available_subject_register',[AdminTimeTableController::class,'addTimeTable'])->middleware('admin');
Route::post('/available_subject_register',[AdminTimeTableController::class,'createTimeTable'])->middleware('admin');
// 今季履修科の科目編集・削除ページを表示
Route::get('/available_subject_edit',[AdminTimeTableController::class,'editTimeTable'])->middleware('admin');
Route::post('/available_subject_edit',[AdminTimeTableController::class,'updateOrdeleteTimeTable'])->middleware('admin');





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


});

