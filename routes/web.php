<?php

use App\Http\Controllers\CommunityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetsController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\LikesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/tweets', [TweetsController::class, 'index'])->name('home');
    Route::post('/tweets', [TweetsController::class, 'store'])->name('tweet-store');
    Route::get('profile/{user:slug}', [ProfileController::class, 'show'])->name('profile');
    Route::get('profile/{user:slug}/edit', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::patch('profile/{user:slug}/update', [ProfileController::class, 'update'])->name('update-profile');
    Route::post('profile/{user:slug}/follow', [FollowsController::class, 'toggleFollow'])->name('toggle');
    Route::get('/community', [CommunityController::class, 'index'])->name('community');
    Route::post('tweet/{tweet:id}/like', [LikesController::class, 'like'])->name('like-tweet');
    Route::post('tweet/{tweet:id}/dislike', [LikesController::class, 'dislike'])->name('dislike-tweet');
});


require __DIR__.'/auth.php';
