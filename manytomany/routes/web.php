<?php

use Illuminate\Support\Facades\Route;
// Models
use App\Models\User;
use App\Models\Role;

// --------------------
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

Route::get('/insert/{id}', function ($id) {
    $user = User::findOrFail($id);
    $data = ['name'=>'administratior'];
    $role = new Role($data);
    $user->roles()->save($role);
    return "inserted";
});


Route::get('/rede/{id}', function ($id) {
    $user = User::findOrFail($id);
    foreach ($user->roles as $role) {
        # code...
        echo $role."<br>";
    }
});

Route::get('/update/{id}', function ($id) {
    $user = User::findOrFail($id);
    if ($user->has('roles')) {
        foreach ($user->roles as $role) {
            if ($role->name == "administratior") {
                $role->name = "Admin";
                $role->save();
                return "updated";
            }
        }
        return "Not Updated";
    }
});

Route::get('/delete/{id}/{rid}', function ($id, $rid) {
    $user = User::findOrFail($id);
    foreach ($user->roles as $role) {
        $role->whereId($rid)->delete();
        return "Deleted";
    }
});


Route::get('/attach', function () {
    $user = User::findOrFail(1);
    $user->roles()->attach(7);
    return "attach";
});

Route::get('/detach', function () {
    $user = User::findOrFail(1);
    $user->roles()->detach(7);
    return "detach";
});


Route::get('/sync', function () {
    $user = User::findOrFail(1);
    $user->roles()->sync([8,9]);
    return "Synced";
});
