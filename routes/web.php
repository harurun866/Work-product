<?php

use App\Http\Controllers\PracticeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatroomController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EventController;
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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/practices', [PracticeController::class, 'index'])->name('practices.index');
    Route::get('/practices/create', [PracticeController::class, 'create'])->name('practices.create');
    Route::post('/practices', [PracticeController::class, 'store'])->name('practices.store');
    Route::get('/practices/{id}', [PracticeController::class, 'show'])->name('practices.show');
    Route::get('/practices/{practice}/edit', [PracticeController::class, 'edit'])->name('practices.edit');
    Route::put('/practices/{practice}', [PracticeController::class, 'update'])->name('practices.update');
    Route::delete('/practices/{practice}', [PracticeController::class, 'delete'])->name('practices.delete');

    Route::get('/chatrooms', [ChatroomController::class, 'index'])->name('chatrooms.index');
    Route::get('/chatrooms/create', [ChatroomController::class, 'create'])->name('chatrooms.create');
    Route::post('/chatrooms', [ChatroomController::class, 'store'])->name('chatrooms.store');
    Route::post('/chatrooms/{id}/join', [ChatroomController::class, 'join'])->name('chatrooms.join');
    Route::get('/chatrooms/{chatroom}/chat', [ChatController::class, 'show'])->name('chatrooms.show');
    Route::get('/chatrooms/joined', [ChatroomController::class, 'joined'])->name('chatrooms.joined');
    Route::post('/chatrooms/{id}/leave', [ChatroomController::class, 'leave'])->name('chatrooms.leave');
    Route::post('/chatrooms/{id}/away', [ChatroomController::class, 'setAway'])->name('chatrooms.away');
    Route::post('/chatrooms/{id}/active', [ChatroomController::class, 'setActive'])->name('chatrooms.active');
    Route::get('/chatrooms/{id}/edit', [ChatroomController::class, 'edit'])->name('chatrooms.edit');
    Route::put('/chatrooms/{id}', [ChatroomController::class, 'update'])->name('chatrooms.update');

    Route::post('/chats/{id}', [ChatController::class, 'store'])->name('chats.post');
    Route::put('/chats/{id}', [ChatController::class, 'update'])->name('chats.update');
    Route::delete('/chats/{id}', [ChatController::class, 'destroy'])->name('chats.destroy');

    Route::get('/dashboard', [EventController::class, 'show'])->name('show');
    Route::post('/dashboard/create', [EventController::class, 'create'])->name('create');
    Route::post('/dashboard/get',  [EventController::class, 'get'])->name("get");
    Route::put('/dashboard/update', [EventController::class, 'update'])->name("update");
    Route::delete('/dashboard/delete', [EventController::class, 'delete'])->name("delete");
});

require __DIR__ . '/auth.php';
