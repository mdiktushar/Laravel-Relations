<?php

use Illuminate\Support\Facades\Route;
// Models
use App\Models\User;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Staff;

// -----------------------------
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

Route::get('/create/{id}', function ($id) {
    $staff = Staff::find($id);
    $staff->photos()->create(['path'=>'1.jpg']);
    return "inserted photo";
});


Route::get('/read/{id}', function ($id) {
    $staff = Staff::findorFail($id);
    foreach ($staff->photos as $photo) {
        echo $photo->path. "<br>";
    }
});

Route::get('update/{id}/{pid}/{path}', function ($id, $pid, $path) {
    $staff = Staff::findorFail($id);
    $photo = $staff->photos()->whereId($pid)->first();
    $photo->path = $path;
    $photo->save();
    return "update";
});

Route::get('delete/{id}/{pid}', function ($id, $pid) {
    $staff = Staff::findorFail($id);
    $photo = $staff->photos()->whereId($pid)->delete();
    return "deleted";
});

Route::get('assign', function () {
    $staff = Staff::findorFail(2);
    $photo = Photo::findorFail(1);
    $staff->photos()->save($photo);
    return "assign";
});

Route::get('un-assign', function () {
    $staff = Staff::findorFail(2);

    $staff->photos()->whereId(1)->update(['imageable_id'=>'Null', 'imageable_type'=>'Null']);
    return "un-assign";
});
