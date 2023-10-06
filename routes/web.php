<?php

use App\Events\DoneEvent;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\TranscationController;
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

// Route::get('/', function () {
//     return view('landing');
// });

Route::get('/', [HomeController::class, 'landing']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('user');

// Route::get('/home/customer', [App\Http\Controllers\HomeController::class, 'customer'])->middleware('user','fireauth');

Route::get('/email/verify', [ResetController::class, 'verify_email'])->name('verify')->middleware('fireauth');

Route::post('login/{provider}/callback', [LoginController::class, 'handleCallback']);

Route::resource('/home/profile', ProfileController::class)->middleware('user','fireauth');

Route::resource('/password/reset', ResetController::class);

Route::resource('/img', ImageController::class);

Route::post('verify', [ResetController::class, 'verify'])->name('reset.verify');

Route::patch('/home/profile/update_password', [ProfileController::class, 'update_password'])->name('profile.password');

Route::group(['middleware' => 'fireauth'], function(){
    //list
    Route::get('station/list', [StationController::class, 'station'])->name('station.list');
    Route::get('station', [StationController::class, 'index3'])->name('station.index');
    Route::get('station/{key}', [StationController::class, 'detail3'])->name('station.detail');
    Route::get('map', [StationController::class, 'map'])->name('station.map');

    //transaction
    Route::get('transaction/detail/{id}', [TranscationController::class, 'detail'])->name('transaction.detail')->middleware('user', 'fireauth');
    Route::get('transaction/history', [TranscationController::class, 'history'])->name('transaction.history')->middleware('user', 'fireauth');
    Route::post('transaction/book/{id}', [TranscationController::class, 'process'])->name('transaction.book')->middleware('user', 'fireauth');
    Route::post('transaction/success/{id}', [TranscationController::class, 'success'])->name('transaction.success');
    Route::delete('transaction/cancel/{id}', [TranscationController::class, 'cancel'])->name('transaction.cancel');
    
    //midtrans
    Route::post('/midtrans/callback', [MidtransController::class, 'notificationHandler']);
    Route::get('/midtrans/finish', [MidtransController::class, 'finish']);
    Route::get('/midtrans/unfinish', [MidtransController::class, 'unfinish']);
    Route::get('/midtrans/error', [MidtransController::class, 'error']);

    Route::get('booking/empty', function(){
        return view('booking.empty');
    })->name('booking.empty');
    // terms
    Route::get('terms', [ProfileController::class, 'terms'])->name('terms');

});

//admin
Route::get('admin/create', [AdminController::class, 'create_admin'])->name('admin.register');
Route::post('create_admin', [AdminController::class, 'process_admin'])->name('admin.create');

//booking
Route::get('booking', [BookingController::class, 'index'])->name('booking.index');
Route::post('get_booking', [BookingController::class, 'process'])->name('booking.get');
Route::get('booking/detail/{id}', [BookingController::class, 'detail'])->name('booking.detail');
Route::post('booking/guide/1/{id}', [BookingController::class, 'setupguide1'])->name('booking.guide1');
Route::post('booking/guide/2/{id}', [BookingController::class, 'setupguide2'])->name('booking.guide2');
Route::post('booking/guide/done/{id}', [BookingController::class, 'done'])->name('booking.done');

// api
Route::get('/monitor', function(){
    return view('api.monitor');
})->name('monitor.index');
Route::get('guide1', [MonitorController::class, 'guide1'])->name('monitor.guide1');
Route::post('monitor/guide/1/{id}', [BookingController::class, 'api_setupguide1'])->name('monitor.guide1');
Route::post('monitor/guide/2/{id}', [BookingController::class, 'api_setupguide2'])->name('monitor.guide2');
Route::post('monitor/guide/done/{id}', [BookingController::class, 'api_done'])->name('monitor.done');
Route::get('terms-condition', function(){
    return view('terms.terms-condition');
});

// Route::post('api/get-transaction', [BookingController::class, 'process']);