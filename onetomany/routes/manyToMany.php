<?php

use Illuminate\Support\Facades\Route;

// Models
use App\Models\User;
use App\Models\Post;

//--------------------------------
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

Route::get('/insert/{id}', function ($id) {
    $user = User::findOrFail($id);
    $post = new Post(['title'=>'two', 'body'=>'2st post of the project']);
    $user->posts()->save($post);
    return $post;
});

Route::get('/read/{id}', function ($id) {
    $user = User::findOrFail($id);
    
    foreach ($user->posts as $post) {
        # code...
        echo $post->title. "<br>";
    }
});

Route::get('/update/{id}/{idp}', function ($id, $idp) {
    $user = User::findOrFail($id);
    $content = ['title'=>'new one', 'body'=>'1st prime post of the project'];
    $user->posts()->whereId($idp)->update($content);
    return $content;
});


Route::get('/delete/{id}/{ipp}', function ($id, $idp) {
    $user = User::findOrFail($id);
    $user->posts()->whereId($idp)->delete();
    return 'Deleted';
});
