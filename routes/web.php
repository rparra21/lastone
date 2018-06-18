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

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', 'WidgetController@index')->name('main');


Auth::routes();


/******* articles ********/
Route::post('/saveFooter', 'ArticleController@saveFooter')->name('saveFooter');
Route::post('/setFirst/{idArticle}', 'ArticleController@setFirst')->name('setFirst');
Route::get('/searchArticles/{name}', 'ArticleController@searchArticles')->name('searchArticles');
Route::post('/updateColor/{idCategory}/{newColor}/{categories?}', 'ArticleController@updateColor')->name('updateColor');
Route::post('/updateType/{id}/{type}', 'ArticleController@updateType')->name('updateType');
Route::post('/updatePosition/{idUp}/{idDown}', 'ArticleController@updatePosition')->name('updatePosition');
Route::get('/articles/{categories?}', 'ArticleController@index')->name('articles');
Route::get('/getall', 'ArticleController@getall')->name('getall');
Route::get('/getArticles/{categories?}', 'ArticleController@getArticlesFilter')->name('getArticles');
Route::get('/getImage/{image_id}/{edit}', 'ArticleController@getImage')->name('getImage');
Route::post('/updatePost/{id}/{id_image}/{name_image}', 'ArticleController@updatePost')->name('updatePost');

Route::resource('article', 'ArticleController');
/******* articles ******** voy a guardarlo*/
Route::get('/home', 'HomeController@index')->name('home');


/******* wizard ********/
Route::get('/wizard', 'WidgetController@index')->name('wizard');
/******* wizard ********/


/******* widget ********/
Route::get('/widget/{snippets}/{quantity}/{categories?}', 'WidgetController@getWidget')->name('widget');

Route::get('/widgetAll', 'WidgetController@widgetAll')->name('widgetAll');
/******* widget ********/

//hay que cambiar el controller
//Route::post('/guardar{request}', 'ArticleController@guardar')->name('guardar');
//Route::post('/store', 'ArticleController@store')->name('store');


/******* users ********/
Route::get('/users', 'UserController@index')->name('users');
/******* users ********/

Route::post('/generateLogs', 'ArticleController@generateLogs')->name('generateLogs');



