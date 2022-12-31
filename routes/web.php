<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Dashboard\MyImagesController as MyImages;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Follower\FollowerController;

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

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', fn() => Inertia::render('Dashboard'))->name('dashboard');
    Route::get('/dashboard/minhas-imagens', [MyImages::class, 'index'])->name('dashboard.my-images.index');
    Route::get('/dashboard/images', [MyImages::class, 'images'])->name('dashboard.my-images.images');
    Route::post('/dashboard/image/{image}/toggle-image-archived-status', [MyImages::class, 'toggle_image_archived_status'])->name('dashboard.my-images.toggle_image_archived_status');
    Route::post('/dashboard/nova-imagem', [MyImages::class, 'store_image'])->name('dashboard.my-images.store');
    Route::delete('/dashboard/delete-image/{image}', [MyImages::class, 'delete_image'])->name('dashboard.my-images.delete');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/imagem/{image}', [HomeController::class, 'image'])->name('home');
    Route::post('/imagem/{image}/novo-comentario', [HomeController::class, 'commentImage'])->name('home.comment_image');
    Route::delete('/imagem/{image}/excluir-comentario/{comment}', [HomeController::class, 'deleteCommentImage'])->name('home.delete_comment_image');
    Route::post('/imagem/{image}/seguir-dono', [FollowerController::class, 'follow_image_owner'])->name('home.follow_image_owner');
    Route::post('/imagem/{image}/deixar-de-seguir-dono', [FollowerController::class, 'unfollow_image_owner'])->name('home.unfollow_image_owner');

});