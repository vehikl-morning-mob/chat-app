<?php

use App\Models\Message;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        "currentUser" => ["username" => 'Bob'],
//        "messages" => [
//            [
//                "content" => 'Hello',
//                "username" => 'Unknown',
//                "time" => '9:00pm'
//            ],
//            [
//                "content" => 'Hi there',
//                "username" => 'Kevin',
//                "time" => '9:01pm'
//            ],
//            [
//                "content" => 'Hey',
//                "username" => 'Kevin',
//                "time" => '9:01pm'
//            ],
//        ]
        "messages" => Message::all()
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
