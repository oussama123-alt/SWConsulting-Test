<?php

use App\Http\Controllers\GroupeController;
use App\Http\Controllers\UtilisateurController;
use App\Models\Groupe;
use App\Models\Utilisateur;
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
    $utilisateurs = Utilisateur::orderBy('nom')->get();
    $groupes = Groupe::orderBy('nom')->get();
    return view('welcome', compact('utilisateurs', 'groupes'));
});

Route::post('/importCSV', [GroupeController::class ,'importCSV'])->name('importCSV');

Route::get('/Utilisateurs/{utilisateur}', [UtilisateurController::class ,'details'])->name('utilisateurDetails');
Route::get('/groupes/{groupe}', [GroupeController::class ,'details'])->name('groupeDetails');


