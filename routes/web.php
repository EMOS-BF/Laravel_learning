<?php

use App\Models\Chambre;
use App\Models\TypeChambre;
use Illuminate\Support\Facades\Route;

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

Route::get('/chambres', function () {
    return Chambre::with("type")->paginate(5);
});

Route::get('/type_chambres', function () {
    return TypeChambre::with("chambre")->paginate(5);
});