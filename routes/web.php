<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrawlerController;

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

Route::get('/', [CrawlerController::class, 'paginate'])->name('Home');
Route::get('/{id}', [CrawlerController::class, 'detail'])->name('Detail');
Route::post('/crawlers', [CrawlerController::class, 'crawling'])->name('Crawling');
