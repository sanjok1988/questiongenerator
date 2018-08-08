<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(array('prefix'=>'subjects'),function(){
    Route::get("/","SubjectsController@index");
    Route::get("/add","SubjectsController@add");
   
    Route::get("/edit/{id}","SubjectsController@edit");
    Route::get("/delete/{id}","SubjectsController@delete");

    Route::post("/store","SubjectsController@store");
    Route::post("/update","SubjectsController@update");
});

Route::group(array('prefix'=>'exams'),function(){
    Route::get("/","ExamsController@index");
    Route::get("/add","ExamsController@add");
   
    Route::get("/edit/{id}","ExamsController@edit");
    Route::get("/delete/{id}","ExamsController@delete");

    Route::post("/store","ExamsController@store");
    Route::post("/update","ExamsController@update");
});


Route::group(array('prefix'=>'questions'),function(){
    Route::get("/","QuestionsController@index");
    Route::get("/add","QuestionsController@add");
   
    Route::get("edit/{id}","QuestionsController@edit");
    Route::get("/delete/{id}","QuestionsController@delete");

    Route::post("/store","QuestionsController@store");
    Route::post("/update","QuestionsController@update");
});

Route::group(array('prefix'=>'papers'), function () {
    Route::get("/", "QPaperGeneratorController@index");
    Route::get("/add", "QPaperGeneratorController@add");
    Route::get("/view", "QPaperGeneratorController@view");
    Route::post("/generate", "QPaperGeneratorController@generateQuestions");

    Route::get("/export/{exam_id}/{subject_id}/{sem}", "QPaperGeneratorController@exportToPdf");
   
    Route::get("edit/{id}","QPaperGeneratorController@edit");
    Route::get("/delete/{id}", "QPaperGeneratorController@delete");

    Route::post("/store","QPaperGeneratorController@store");
    Route::post("/update","QPaperGeneratorController@update");
});

Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
 // Registration Routes...
 Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
 Route::post('register', 'Auth\RegisterController@register');