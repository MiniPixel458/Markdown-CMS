<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{	$article = DB::table('Article')->where('slug','welcome')->first();
	return View::make('render',array('article'=>$article));
});
Route::group(array('prefix' => 'editor'),function(){
	Route::get('/','EditorController@ListeArticle');
	Route::get('add',function()
	{
		return View::make('editor.new');
	});
	Route::post('add','EditorController@NewArticle');
	Route::post('parser',function()
	{
		return Markdown::render(Input::get('markdown'));
	});
	Route::get('edit/{id}','EditorController@ShowEdit');
	Route::post('edit/{id}','EditorController@Edit');

});
Route::pattern('slug','.*');
Route::get('{slug}',function($slug){
	$article = DB::table('Article')->where('slug',$slug)->first();
	return View::make('render',array('article'=>$article));
});