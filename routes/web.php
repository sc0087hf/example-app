<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Mail\NewUserIntroduction;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\PositiveMessage;
use App\Http\Controllers\CsvExportController;

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

require __DIR__.'/auth.php';

//練習のサンプルサイト
Route::get('/sample', [\App\Http\Controllers\Sample\IndexController::class, 'show']);
Route::get('/sample/{id}', [\App\Http\Controllers\Sample\IndexController::class, 'showId']);


//つぶやきサイト
Route::middleware('auth')
    ->name('tweet.')
    ->group(function() {
        Route::post('/tweet/create', \App\Http\Controllers\Tweet\CreateController::class)->name('create');
        Route::get('/tweet/update/{tweetId}', \App\Http\Controllers\Tweet\Update\IndexController::class)->whereNumber('tweetId')->name('update.index');
        Route::put('/tweet/update/{tweetId}', \App\Http\Controllers\Tweet\Update\PutController::class)->whereNumber('tweetId')->name('update.put');
        Route::delete('/tweet/delete/{tweetId}', \App\Http\Controllers\Tweet\DeleteController::class)->whereNumber('tweetId')->name('delete');
    });

Route::get('/tweet/member/{userId}', \App\Http\Controllers\Tweet\MemberPage\IndexController::class)->whereNumber('userId')->name('tweet.member');
Route::post('/tweet/member', \App\Http\Controllers\Tweet\MemberPage\PostController::class)->name('tweet.post.member');

Route::get('/tweet', \App\Http\Controllers\Tweet\IndexController::class)->name('tweet.index');

//csv出力
Route::get('/export-csv', [CsvExportController::class, 'exportUser'])->name('export.csv');
Route::get('/export-csv/{user}', [CsvExportController::class, 'exportTweet'])->name('export.tweet.csv');

//メール送信
Route::get('/send-test-mail', function() {
    $users = User::all();
    foreach($users as $user) {
        $message = PositiveMessage::inRandomOrder()->first();
        Mail::to($user->email)->send(new NewUserIntroduction($user, $message));
    }
    
    return 'Test mail sent!';
});
