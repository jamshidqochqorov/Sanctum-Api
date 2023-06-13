<?php

use Illuminate\Support\Facades\Http;
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
    Http::post('https://api.telegram.org/bot5570623803:AAEhWWYH7SYQ3iQRjaEpGrh4OLvHf4JOloc/sendMessage',[
        'chat_id'=>1814409422,
        'text'=>'Mening ismim jamshid men beckend dasturchiman😁'
    ]);
});
