<?php

use Illuminate\Support\Facades\Route;

// Models
use App\Models\User;
use App\Models\Address;

//-----------------------------------

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
    //inserting data
    $user = User::findOrFail($id);
    $address = new Address(['name'=>'cal 123 avanue']);
    $user->address()->save($address);
    return "Inserted";
});

Route::get('/update/{id}', function ($id) {
    $address = Address::whereUserId($id)->first();
    $address->name = "new dhaka";
    $address->save();
    
    return "updated";
});

Route::get('/read/{id}', function ($id) {
    $user = User::findOrFail($id);
    return $user->address->name;
});

Route::get('/delete/{id}', function ($id) {
    $user = User::findOrFail($id);
    $user->address()->delete();
    return "Deleted";
});
