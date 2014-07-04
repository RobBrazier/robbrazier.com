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

Route::get('/', 'HomeController@getIndex');
Route::get('about', 'HomeController@getAbout');
Route::get('contact', 'HomeController@getContact');
Route::group(array('prefix'=>'projects'), function() {
	Route::get('/', 'ProjectsController@getIndex');
	Route::get('coolrob335-com', 'ProjectsController@getCoolrob335');
	Route::get('entitydecode-com', 'ProjectsController@getEntityDecode');
	Route::get('recloud', 'ProjectsController@getRecloud');
	Route::get('mypcspecs-io', 'ProjectsController@getMypcspecs');
	Route::get('laravel-piwik', 'ProjectsController@getLaravelPiwik');
	Route::get('laravel-piwik/{param}', 'ProjectsController@getLaravelPiwik');
});
Route::get('portfolio/{any}', function($any) {
	return Redirect::to('projects/'.$any);
});
Route::get('portfolio', function() {
	return Redirect::to('projects');
});
Route::get('blog', 'BlogController@getIndex');
Route::get('blog/feed', 'BlogFeedController@getFeed');
Route::get('blog/feed.rss', 'BlogFeedController@getFeed');
Route::get('blog/{post}', 'BlogController@getPost');
// Route::get('feed', 'BlogFeedController@getFeed');