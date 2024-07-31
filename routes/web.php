<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Mail\NewUserIntroduction;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\PositiveMessage;
use App\Http\Controllers\CsvExportController;
use App\Http\Controllers\Sample\IndexController;

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

//MVC練習のサイト
Route::prefix('sample')
    ->controller(IndexController::class)
    ->group(function() {
        Route::get('/', 'show');
        Route::get('/{id}', 'showId')->whereNumber('id');
    });

//つぶやきサイト
Route::prefix('tweet')
    ->name('tweet.')
    ->group(function() {
        //つぶやきサイトトップ
        Route::get('/', \App\Http\Controllers\Tweet\IndexController::class)->name('index');

        //つぶやきCRUD
        Route::post('/create', \App\Http\Controllers\Tweet\CreateController::class)->name('create')->middleware('auth');
        Route::get('/update/{tweetId}', \App\Http\Controllers\Tweet\Update\IndexController::class)->whereNumber('tweetId')->name('update.index')->middleware('auth');
        Route::put('/update/{tweetId}', \App\Http\Controllers\Tweet\Update\PutController::class)->whereNumber('tweetId')->name('update.put')->middleware('auth');
        Route::delete('/delete/{tweetId}', \App\Http\Controllers\Tweet\DeleteController::class)->whereNumber('tweetId')->name('delete')->middleware('auth');

        //個人つぶやきの処理
        Route::get('/member/{userId}', \App\Http\Controllers\Tweet\MemberPage\IndexController::class)->whereNumber('userId')->name('member');
        Route::post('/member', \App\Http\Controllers\Tweet\MemberPage\PostController::class)->name('post.member');
    });

//csv出力
Route::prefix('export-csv')
    ->name('export.')
    ->controller(CsvExportController::class)
    ->group(function() {
        //ユーザー一覧を出力
        Route::get('', 'exportUser')->name('csv');
        //ユーザーのつぶやきを出力
        Route::get('/{userId}', 'exporTweet')->whereNumber('userId')->name('tweet.csv');
    });

//メール送信
Route::get('/send-test-mail', function() {
    $users = User::all();
    foreach($users as $user) {
        $message = PositiveMessage::inRandomOrder()->first();
        Mail::to($user->email)->send(new NewUserIntroduction($user, $message));
    }
    
    return 'Test mail sent!';
});
