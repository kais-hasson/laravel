<?php

use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use MailchimpMarketing\ApiClient;

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

//Route::get('/', function () {
////    return Inertia::render('Welcome', [
////        'canLogin' => Route::has('login'),
////        'canRegister' => Route::has('register'),
////        'laravelVersion' => Application::VERSION,
////        'phpVersion' => PHP_VERSION,
////    ]);
//});

//Route::get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});
//
//require __DIR__.'/auth.php';
//Route::get('ping',function (){
//    $mailchimp=new ApiClient();
//
//    $mailchimp->setConfig([
//        'apiKey'=>config('services.mailchimp.key'),
//        'server'=>'us21'
//    ]);
//    $response=$mailchimp->ping->get();
//
//    ddd($response);
//});
Route::get('ping',function(){

    require_once('C:\Users\hp\blog-app\vendor\autoload.php');

    function run()
    {
        try {
            $mailchimp = new MailchimpTransactional\ApiClient();
            $mailchimp->setApiKey(config('services.mailchimp.key'));
            $response = $mailchimp->users->ping();
           ddd($response);
        } catch (Error $e) {
            echo 'Error: ', $e->getMessage(), "\n";
        }
    }

    run();
});
Route::get('/',[PostController::class,'index'])->name('home');
Route::get('posts/{post:slug}',[PostController::class,'show']);

Route::post('posts/{post:slug}/comments',[PostCommentsController::class,'store']);

Route::get('register',[RegisterController::class,'create'])->middleware('guest');
Route::post('register',[RegisterController::class,'store'])->middleware('guest');

Route::get('login',[SessionsController::class,'create'])->middleware('guest');
Route::post('login',[SessionsController::class,'store'])->middleware('guest');
Route::post('logout',[SessionsController::class,'destroy'])->middleware('auth');
Route::get('admin/posts/create',[PostController::class,'create']);