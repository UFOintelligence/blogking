<?php
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContactController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middl  eware group. Now create something great!
|
*/

Route::get('/', WelcomeController::class)->name('home');

Route::get('/posts/{post}', [PostController::class, 'show' ])->name('posts.show');

Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::post('contacts', [ContactController::class, 'store'])->name('contacts.store');

Route::get('/autocomplete', [PostController::class, 'searchAutocomplete'])->name('autocomplete');


