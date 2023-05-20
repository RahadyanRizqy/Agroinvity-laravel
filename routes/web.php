<?php

use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
    return view('homepage');
});

Route::get('/service', function() {
    return "Draft";
});

Route::get('/feature', function() { 
    return "Draft"; 
});

// Route::get('/login', function() {
//     return view('login');
// });

Route::get('/dashboard', function() {
    return view('dashboard', compact('id'));
});

Route::get('/login', function() { 
    return view("usersession/login");
});

Route::get('/register', function() { 
    return view("usersession/register");
});

Route::resource('articles', ArticleController::class);

// Route::get('');

// Route::get('/session', function() {
//     return view("")
// })
// ^^^
// Hirarki route berpengaruh pada asset terutama saat multichilding
// Jadi meskipun direktori file berbeda namun hirarki saat di extend via '/' maka harus 1 hirarki yang sama
// bila login berada pada sub direkotori dibawah parent maka harus sejajar routenya