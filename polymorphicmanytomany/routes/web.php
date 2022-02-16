<?php

use Illuminate\Support\Facades\Route;

// Modles
use App\Models\User;

use App\Models\Post;

use App\Models\Tag;

use App\Models\Taggable;

use App\Models\Video;

// -------------------------------------------------------------------
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

Route::get('/create', function () {
    $post = Post::create(['name'=>'my post 1']);
    $tag1 = Tag::find(1);
    $post->tags()->save($tag1);
    $video = Video::create(['name'=>'my video 1.mp4']);
    $tag2 = Tag::find(1);
    $video->tags()->save($tag2);

    return "create";
});

Route::get('/read', function () {
    $post = Post::findOrFail(1);

    foreach ($post->tags as $tag) {
        echo $tag ."<br>";
    }
});

Route::get('/update', function () {
    // $post = Post::findOrFail(1);

    // foreach ($post->tags as $tag) {
    //     $tag->whereName('Update js')->update(['name'=>"js"]);
    // }

    $post = Post::findOrFail(1);
    $tag = Tag::find(3);
    // $post->tags()->save($tag);
    // $post->tags()->attach($tag);
    // $post->tags()->sync([1]);


    return 'updated';
});


Route::get('/delete', function () {
    $post = Post::find(1);

    foreach ($post->tags as $tag) {
        $tag->whereId(1)->delete();
    }

    return 'delete';
});
