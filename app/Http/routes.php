<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', array('as' => 'testUrl', function () {

    $url = route('testUrl');

    return 'This is the URL ' . $url;

}));

Route::get('/post/{id}', function ($id) {

    return 'Post number ' . $id;
});


//-*-*-*-*-*--*-*-*-*--*-*--*-*

// Controller access by router

//-*-*-*-*-*--*-*-*-*--*-*--*-*

Route::get('/post', 'PostsController@index');

Route::get('/getID/{id}', 'PostsController@edit');

Route::resource('postinformation', 'PostsController');

Route::get('/firstpage', 'PostsController@showFirstPage');

Route::get('/showmyname/{name}/{surname}', 'PostsController@showMyName');