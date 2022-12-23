<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMail;


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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/notify-mail', function () {

//     $user = new stdClass();
//     $user->name = 'Fernando';
//     $user->email = 'hodnan@gmail.com';

//     return $content = new NotifyMail($user);

//     try {
//         //code...
//        Mail::to('hodnan@gmail.com')->send($content);
//     } catch (\Throwable $th) {
//         return $th;
//     }

// });