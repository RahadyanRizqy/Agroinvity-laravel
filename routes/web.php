<?php

use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Contracts\Session\Session;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/super', function() {
    return view('super');
});

// Route::get('/forms', function() {
//     return view('forms/product_form');
// })->name('forms.insert');



// Route::get('/login', function() {
//     return view('login');
// });

Route::get('login', function() { 
    return view("usersession/login");
});

Route::get('register', function() { 
    return view("usersession/register");
});

Route::get('dashboard', [DashboardController::class, 'showDashboard'])->name('section.main');
Route::get('dashboard/article', [DashboardController::class, 'indexArticle'])->name('section.article');
Route::get('dashboard/report', [DashboardController::class, 'indexReport'])->name('section.report');
Route::get('dashboard/calculator', [DashboardController::class, 'indexCalculator'])->name('section.calculator');


// Route::get('dashboard/material', [DashboardController::class, 'indexMaterial'])->name('section.material');
// Route::get('dashboard/operational', [DashboardController::class, 'indexOperational'])->name('section.operational');
Route::get('dashboard/production', [DashboardController::class, 'indexProduction'])->name('section.production');

Route::get('dashboard/expenses/{type_id}', [DashboardController::class, 'indexExpense'])->name('section.expenses');

// Route::get('dashboard/expenses/{type_id}', [DashboardController::class, 'createExpense'])->name('expenses.create');

// Route::resource('dashboard/material', ExpenseController::class);

// Route::get('dashboard/1', function() {
//     return view('dashboard')->with('mainSection', 1);
// });

// Route::get('dashboard/2', function() {
//     return view('dashboard')->with('mainSection', 2);
// });

// Route::get('dashboard/3', function() {
//     return view('dashboard')->with('mainSection', 3);
// });

// Route::get('dashboard?mainSection={mainSection}', function($mainSection) {
//     return view('dashboard')->with('mainSection', $mainSection);
// })->where('mainSection', '[0-3]');

Route::resource('articles', ArticleController::class);

// Route::get('dashboard', function () {
//     $section = request()->query('section');
//     return view('dashboard')->with('section', $section);
// });

// Route::get('dashboard?section=article', function() {
//     return view('dashboard')->with('section', 'article');
// });

// Route::get('');

// Route::get('/session', function() {
//     return view("")
// })
// ^^^
// Hirarki route berpengaruh pada asset terutama saat multichilding
// Jadi meskipun direktori file berbeda namun hirarki saat di extend via '/' maka harus 1 hirarki yang sama
// bila login berada pada sub direkotori dibawah parent maka harus sejajar routenya