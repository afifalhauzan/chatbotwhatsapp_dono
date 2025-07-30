<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BotReplyController;

Route::get('/', function () {
    // Arahkan langsung ke halaman login jika belum login, atau ke dashboard jika sudah
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Route bawaan Breeze untuk dashboard & profil
    Route::get('/dashboard', function () {
        return redirect()->route('admin.bot_replies.index');
    })->name('dashboard');

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- Letakkan route admin Anda di sini ---
    Route::resource('/admin/balasan-bot', BotReplyController::class)
        ->names('admin.bot_replies');
});

require __DIR__ . '/auth.php';
