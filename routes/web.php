<?php
use App\Http\Controllers\HomeController;
use App\Http\Middleware\DetectUserType;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
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

Auth::routes();

Route::middleware([DetectUserType::class])->group(function () {
    Route::get('/profile', [HomeController::class, 'index'])->name('profile');
    Route::get('/category', [App\Http\Controllers\HomeController::class, 'category'])->name('category');
    Route::get('/products', [App\Http\Controllers\HomeController::class, 'products'])->name('products');
    Route::post('/upload-profile-image', [ProfileController::class, 'uploadProfileImage'])->name('profileImage');
});




