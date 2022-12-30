<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Dashboard\MyImagesController as MyImages;
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

Route::get('/', fn() => 
    Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ])
);

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', fn() => Inertia::render('Dashboard'))->name('dashboard');
    Route::get('/dashboard/minhas-imagens', [MyImages::class, 'index'])->name('dashboard.my-images.index');
    Route::get('/dashboard/images', [MyImages::class, 'images'])->name('dashboard.my-images.images');
    Route::post('/dashboard/image/{image}/toggle-image-archived-status', [MyImages::class, 'toggle_image_archived_status'])->name('dashboard.my-images.toggle_image_archived_status');
    Route::post('/dashboard/nova-imagem', [MyImages::class, 'store_image'])->name('dashboard.my-images.store');
    Route::delete('/dashboard/delete-image/{image}', [MyImages::class, 'delete_image'])->name('dashboard.my-images.delete');
});
