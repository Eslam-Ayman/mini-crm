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
/* share is making static variable on all the view balde only but singleton
 static variable will be shared in all files in the all of the project */
// view()->share('lolo', 'soso'); >>>> $lolo
// view::share('lolo', 'soso'); >>>> $lolo
// app::singleton('lolo', 'soso'); >>>> app('lolo')
app()->singleton('lang',function(){
	$local = session()->get('lang');
	App::setLocale($local);
});
route::get('/lang/{local}', function($local){
	session()->put('lang', $local);
	return back();
	// dd(App::getLocale());
});

Route::group(['prefix'=>'ar'], function(){
	

});


Route::get('/', function () {
    return view('welcome');
});

route::resource('company', 'CompanyController');

// route::get('employee', 'EmployeeController@index');
route::resource('employee', 'EmployeeController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
