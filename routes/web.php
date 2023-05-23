<?php

use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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

// SESI
Route::resource('login', LoginController::class);
Route::resource('register', RegisterController::class);

// DASHBOARD

Route::get('dashboard', [DashboardController::class, 'showDashboard'])->name('section.main');
Route::get('dashboard/article', [DashboardController::class, 'indexArticle'])->name('section.article');
Route::get('dashboard/report', [DashboardController::class, 'indexReport'])->name('section.report');
Route::get('dashboard/calculator', [DashboardController::class, 'indexCalculator'])->name('section.calculator');
Route::get('dashboard/production', [DashboardController::class, 'indexProduction'])->name('section.production');
Route::get('dashboard/expenses/{type_id}', [DashboardController::class, 'indexExpense'])->name('section.expenses');
Route::get('dashboard/expenses/{type_id}', [DashboardController::class, 'indexExpense'])->name('section.expenses');
Route::get('dashboard/logout', [DashboardController::class, 'dashboardLogout'])->name('session.destroy');
Route::get('dashboard/profile', function() { return view('forms/account');})->name('dashboard.profile');
// CRUD PENGELUARAN
Route::get('expenses/{type_id}/create', [ExpenseController::class, 'create'])->name('expenses.create');
Route::post('expenses/{type_id}/store', [ExpenseController::class, 'store'])->name('expenses.store');
Route::delete('expenses/{expense}/delete', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
Route::get('expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
Route::put('expenses/{expense}/update', [ExpenseController::class, 'update'])->name('expenses.update');

// CRUD PEMASUKAN

Route::resource('articles', ArticleController::class);

// FORBIDDEN ACCESS

Route::get('forbidden', function() { return view('forbidden'); });
// Route::resource('expenses',ExpenseControl;ler::class);
// Route::post('/expenses/{type_id}', 'ExpenseController@store')->name('expenses.store');

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