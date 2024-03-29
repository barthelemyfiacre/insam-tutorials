<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ChapterController;
use App\Http\Controllers\admin\LessonController;
use App\Http\Controllers\admin\TestController;
use App\Http\Controllers\admin\BookCategoryController;
use App\Http\Controllers\admin\BookController;
use App\Http\Controllers\admin\HomeController;
use App\Models\Chapter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//route admin 
Route::prefix('dashboard')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard'); //OK
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/students', [HomeController::class, 'studentsDashboard'])->name('studentsDashboard'); //ok
    Route::get('/settings/{user:id}', [HomeController::class, 'settingDashboard'])->name('settingDashboard'); //ok
    Route::post('/setting-update/{user:id}', [HomeController::class, 'settingUpdate'])->name('settingUpdate'); //ok
    Route::get('/admins', [HomeController::class, 'adminDashboard'])->name('store'); //ok
    Route::post('/add-admin', [HomeController::class, 'store'])->name('addadmin'); //ok
    Route::post('/edit-admin', [HomeController::class, 'edit'])->name('edit'); //ok
    Route::post('/delete-admin', [HomeController::class, 'delete'])->name('delete'); //ok

    Route::group([
        'prefix' => 'book_categories',
        'as' => 'book_categories.'
    ], function () {
        Route::get('create/', [BookCategoryController::class, 'create'])->name('create');
        Route::post('', [BookCategoryController::class, 'store'])->name('store');
        Route::get('', [BookCategoryController::class, 'index'])->name('index'); //ok
        Route::get('/{bookCategory}', [BookCategoryController::class, 'adminShow'])->name('show'); //ok
        Route::post('update/{bookCategory}', [BookCategoryController::class, 'update'])->name('update'); //ok
        Route::get('edit/{bookCategory}', [BookCategoryController::class, 'edit'])->name('edit'); //ok
        Route::get('delete/{bookCategory}', [BookCategoryController::class, 'destroy'])->name('delete'); //ok
    });


    Route::group([
        'prefix' => 'books',
        'as' => 'books.'
    ], function () {
        Route::get('/', [BookController::class, 'index'])->name('index'); //ok
        Route::get('{bookCategory}', [BookController::class, 'create'])->name('create'); //ok
        Route::post('store/{bookCategory}', [BookController::class, 'store'])->name('store'); //ok
        Route::post('update/{book}', [BookController::class, 'update'])->name('update'); //ok
        Route::get('edit/{book}', [BookController::class, 'edit'])->name('edit'); //ok
        Route::get('delete/{book}', [BookController::class, 'destroy'])->name('delete'); //ok
        Route::get('all-create/{user}', [BookController::class, 'allCreate'])->name('allCreate'); //ok
        Route::post('all-store', [BookController::class, 'allStore'])->name('allStore'); //ok
    });

    Route::group([
        'prefix' => 'exams',
        'as' => 'exams.'
    ], function () {

        Route::get('/admin/exam/{chapter}', [TestController::class, 'examDashboard'])->name('examDashboard'); //ok
        Route::post('/add-exam/{chapter}', [TestController::class, 'addExam'])->name('addExam'); //ok
        Route::get('/get-exam-detail /{id}', [TestController::class, 'getExamDetail'])->name('getExamDetail'); //OK
        Route::post('/update-exam/{chapter}', [TestController::class, 'updateExam'])->name('updateExam'); //ok
        Route::post('/delete-exam', [TestController::class, 'deleteExam'])->name('deleteExam'); //ok



        //exam review route

        Route::get('/admin/review-exams', [TestController::class, 'reviewExams'])->name('reviewExams'); //ok
        Route::get('/get-reviewed-qna', [TestController::class, 'reviewQna'])->name('reviewQna'); //ok
        Route::post('/approved-qna', [TestController::class, 'approvedQna'])->name('approvedQna');
    });

    Route::group([
        'prefix' => 'tests',
        'as' => 'tests.'
    ], function () {

        Route::get('/', [TestController::class, 'index'])->name('index'); //ok
        Route::get('{chapter}', [TestController::class, 'create'])->name('create'); //ok
        Route::post('store/{chapter}', [TestController::class, 'store'])->name('store'); //ok
        Route::post('/update-delete-ans', [TestController::class, 'updateQna'])->name('updateQna');
        Route::get('delete/{question}', [TestController::class, 'destroy'])->name('delete'); //ok
        Route::get('/delete-ans/{chapter}', [TestController::class, 'deleteAns'])->name('deleteAns');
        Route::get('/get-qna-details /{chapter}', [TestController::class, 'getQnaDetails'])->name('getQnaDetails'); //OK
        //exam marks route
        Route::get('/admin/marks', [TestController::class, 'loadMarks'])->name('loadMarks'); //OK
        Route::post('/update-marks', [TestController::class, 'updateMarks'])->name('updateMarks'); //OK
    });

    Route::group([
        'prefix' => 'courses',
        'as' => 'courses.'
    ], function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('create/{category:slug}', [CourseController::class, 'create'])->name('create'); //ok
        Route::post('store/{category}', [CourseController::class, 'store'])->name('store'); //ok
        Route::post('/{course}', [CourseController::class, 'update'])->name('update'); //ok
        Route::get('{course:slug}/edit', [CourseController::class, 'edit'])->name('edit'); //OK
        Route::get('{course}/delete', [CourseController::class, 'deletecourse'])->name('delete'); //OK
        Route::get('{course:slug}', [CourseController::class, 'show'])->name('show'); //ok


        Route::get('all-create/{user}', [CourseController::class, 'allCreate'])->name('allCreate'); //ok
        Route::post('allStore/{user}', [CourseController::class, 'allStore'])->name('allStore'); //ok
    });

    Route::group([
        'prefix' => 'chapters',
        'as' => 'chapters.'
    ], function () {
        Route::get('/', [ChapterController::class, 'index'])->name('index'); //Ok
        Route::get('{course:slug}', [ChapterController::class, 'create'])->name('create'); //ok
        Route::post('store/{course}', [ChapterController::class, 'store'])->name('store'); //ok
        Route::post('all-store/', [ChapterController::class, 'allStore'])->name('allStore'); //ok
        Route::post('edit/{course}', [ChapterController::class, 'edit'])->name('edit'); //OK
        Route::get('delete-chapter/{course}', [ChapterController::class, 'deleteChapter'])->name('deleteChapter'); //OK
        Route::get('show/{chapter}', [ChapterController::class, 'adminShow'])->name('show'); //ok

    });

    Route::group([
        'prefix' => 'categories',
        'as' => 'categories.'
    ], function () {
        Route::get('', [CategoryController::class, 'index'])->name('index'); //ok
        Route::get('create/', [CategoryController::class, 'create'])->name('create');
        Route::post('create/', [CategoryController::class, 'store'])->name('store');
        Route::get('edit/{category}', [CategoryController::class, 'edit'])->name('edit'); //ok
        Route::get('/{category:slug}', [CategoryController::class, 'show'])->name('show'); //ok
        Route::post('/{category}', [CategoryController::class, 'update'])->name('update'); //ok
        Route::get('delete/{category:id}', [CategoryController::class, 'destroy'])->name('delete'); //ok
    });



    Route::group([
        'prefix' => 'lessons',
        'as' => 'lessons.'
    ], function () {
        Route::get('/', 'LessonController@index');
        Route::get('{chapter:slug}', [LessonController::class, 'create'])->name('create'); //ok
        Route::get('lien/{chapter}', [LessonController::class, 'createlien'])->name('createlien'); //ok
        Route::post('store/{chapter}', [LessonController::class, 'store'])->name('store'); //ok
        Route::post('storelink/{chapter}', [LessonController::class, 'storelink'])->name('storelink'); //ok
        Route::get('edit/{lesson}', [LessonController::class, 'edit'])->name('edit'); //ok
        Route::get('show/{course}', [LessonController::class, 'show'])->name('show');
        Route::post('update/{lesson}', [LessonController::class, 'update'])->name('update'); //ok
        Route::get('delete/{lesson}', [LessonController::class, 'destroy'])->name('delete'); //ok
        Route::get('/', [LessonController::class, 'allVideos'])->name('allVideos'); //ok
        Route::get('/all-create-videos/{user}', [LessonController::class, 'allCreate'])->name('allCreate'); //ok
        Route::get('/all-create-video-lien/{user}', [LessonController::class, 'allCreateLien'])->name('allcreatelien'); //ok
    });




    //     //students route
    //     Route::group(['middleware' => ['admin']], function () {

    //         Route::group([
    //             'prefix' => 'students',
    //             'as' => 'students.'
    //         ], function () {

    //             Route::get('/admin/students', [HomeController::class, 'studentsDashboard'])->name('studentsDashboard'); //ok
    //             Route::post('/add-student', [HomeController::class, 'addStudent'])->name('addStudent'); //ok
    //             Route::post('/edit-student', [HomeController::class, 'editStudent'])->name('editStudent'); //ok
    //             Route::post('/delete-student', [HomeController::class, 'deleteStudent'])->name('deleteStudent'); //ok

    //         });
    //     });

});
