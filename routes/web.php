<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Log;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AssistController;
use App\Http\Controllers\NoteController;
use App\Http\Resources\Student;
use App\Models\Assist;
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

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);
// login
Route::get('/log', function () {
    // ...
})->middleware([Log::class]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductController::class);
    Route::resource('students', StudentController::class);
    Route::resource('notes', NoteController::class);

    Route::get('addAssist', function () {
        return view('students.addAssistForm');
    })->name('assist.form');

    Route::post('newAssistt', [AssistController::class, 'store'])->name('assistForm.store');
    Route::post('newAssist', [AssistController::class, 'search'])->name('assistForm.search');
    
    
    Route::get('assist/{student}/student', [AssistController::class, 'show'])->name('assist.show');
    Route::get('details', [ProductController::class, 'details']);
    Route::get('outJson', [ProductController::class, 'outJson']);
    Route::get('assistance', [ProductController::class, 'assistance']);
    Route::post('insertProduct', [ProductController::class, 'insertProduct']);
});
// https://kinsta.com/es/blog/laravel-breeze/
require __DIR__ . '/auth.php';