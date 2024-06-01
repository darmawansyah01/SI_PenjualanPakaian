<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;

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
//     return view('welcome');
// });

route::get('/', function() {
    return view('auth.login', [
        'title' => 'Login',
    ]);
});

route::get('/register', function() {
    return view('auth.register', [
        'title' => 'Register',
    ]);
});

route::get('/logout', function (Request $request) {
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/');
});

route::get('/dashboard', function() {
    return view('dashboard.index', [
        'title' => 'Dashboard',
    ]);
});

route::resource('user', UserController::class);

route::resource('pegawai', PegawaiController::class);

route::resource('barang', BarangController::class);

route::resource('supplier', SupplierController::class);

route::get('/transaksi', [TransaksiController::class, 'index']);
route::delete('/transaksi/{transaksi}', [TransaksiController::class, 'destroy']);
route::post('/transaksi', [TransaksiController::class, 'store']);
