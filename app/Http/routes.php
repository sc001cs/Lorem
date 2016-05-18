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

use App\User;
use App\Post;

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

/*-*-*-*-*-*--*-*-*-*--*-*--*-*
 * SQL Raw CRUD
 *-*-*-*-*-*--*-*-*-*--*-*--*-*/
Route::get('/insert', function () {


    DB::insert('insert into posts(textsomewhere, content) values(?, ?)', ['Some text here', 'Another text here']);

});

Route::get('/read', function () {

    $result = DB::select('select * from posts where id = ?', [1]);

    return json_encode($result);

});

Route::get('/update', function () {

    $updated = DB::update('update posts set content = ? where id = ?', ['Change', 1]);

    return $updated;
});

Route::get('/delete', function () {

    $deleted = DB::delete('delete from posts where id = ?', [1]);

    return $deleted;
});

/*-*-*-*-*-*--*-*-*-*--*-*--*-*
 * Eloquent ORM
 *-*-*-*-*-*--*-*-*-*--*-*--*-*/

Route::get('/getall', function () {

    $posts = \App\Post::all();

    foreach ($posts as $item) {

        return $item->content;
    }

});

Route::get('/find/{id}', function ($id) {

    $post = \App\Post::find($id);

    if(isset($post))
        return $post->content;
    else {
        return 'Post with id ' . $id . ' not found.';
    }
});

Route::get('/findwhere', function () {

    $posts = \App\Post::where('content', 'Tesfa')->orderBy('id', 'asc')->take(2)->get();

    return $posts;
});

Route::get('insertrow/{content}/{text}', function ($content, $text) {

    $post = new \App\Post();

    $post->content = $content;
    $post->textsomewhere = $text;

    $post->save();

    return $post;

});

Route::get('/create', function () {

    \App\Post::create(['content'=>'This is the good text', 'textsomewhere'=>'textsom', 'admin'=>'dsa']);
});

Route::get('/deletesoft/{id}', function ($id) {

    $post = \App\Post::find($id)->delete();


});

/*-*-*-*-*-*--*-*-*-*--*-*--*-*
 * Eloquent Relationship
 *-*-*-*-*-*--*-*-*-*--*-*--*-*/

// One to one relationship
Route::get('/user/{id}/post/', function ($id) {

    return User::find($id)->post->content;
});

// One to one inverse
Route::get('/post/{id}/user', function ($id) {

    return Post::find($id)->user;
});

// One to many relationship
Route::get('getrelationpost', function () {

    $user = User::find(1);

    $postTitle = array();
    foreach ($user->posts as $post) {

        array_push($postTitle, $post->title);
    }

    return $postTitle;

});

// many to many
Route::get('/user/{id}/role/', function ($id) {

    $user = User::find($id);

    foreach ($user->roles as $role) {
        return $role->name;
    }
});