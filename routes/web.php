<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrashNoteController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource("/notes", NoteController::class)->middleware("auth");

Route::prefix("/trash/notes")->name("trash.notes")->middleware("auth")->group(function(){
    Route::get("/",[TrashNoteController::class,"index"])->name("");
    Route::get("/{note}",[TrashNoteController::class,"show"])->name(".show")->withTrashed();
    Route::put("/{note}",[TrashNoteController::class,"update"])->name(".update")->withTrashed();
    Route::delete("/{note}",[TrashNoteController::class,"delete"])->name(".destroy")->withTrashed();
});

require __DIR__.'/auth.php';
