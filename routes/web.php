<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\AuthenticatedSessionController;

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


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', \App\Http\Livewire\Pages\Main::class)->name('home');
    Route::get('/home/print/{examId}', \App\Http\Livewire\Pages\PrintExam::class);
    // Route::get('/home/print',[App\Http\Controllers\PrintExam::class, 'index']);
    // Route::get('/dashboard', \App\Http\Livewire\Pages\PageDashboardIndex::class);
    // Route::get('/payments', \App\Http\Livewire\Pages\PagePaymentIndex::class);

    // Route::get('/patients', \App\Http\Livewire\Pages\PagePatientIndex::class);
    // Route::get('/orders', \App\Http\Livewire\Pages\PageOrderIndex::class);
    // Route::get('/appointments', \App\Http\Livewire\Pages\PageAppointmentIndex::class);

    // Route::get('/inventory', \App\Http\Livewire\Pages\PageInventoryIndex::class);
    // Route::get('/reorder', \App\Http\Livewire\Pages\PageReorderIndex::class);
    // Route::get('/suppliers', \App\Http\Livewire\Pages\PageSupplierIndex::class);

    // Route::get('/profile', \App\Http\Livewire\Pages\PageProfileIndex::class);
    // Route::get('/reports', \App\Http\Livewire\Pages\PageReportIndex::class);
});



require __DIR__.'/auth.php';

Auth::routes();

