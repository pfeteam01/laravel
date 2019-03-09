<?php
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
    return view("welcome");
});

Route::get('/inscription','userController@afficherInscription');
Route::post('/inscription','userController@creerUser');
Route::get('/confirm/{id}/{token}','userController@confirmer');

Route::get('/connexion','authController@afficherConnexion');
Route::post('/connexion','authController@connect');

Route::group([
    'middleware' => 'App\Http\Middleware\Authentification',
],function (){
    Route::get('/profil','profilController@afficherProfil');
    Route::get('/deconnexion','profilController@deconexion');
    Route::get('/modifierprofil','profilController@afficherModifierProfil');
    Route::post('/modifierprofil','profilController@traitementmodifprofil');
    Route::get('/modifierprofil/supprimeravatar','profilController@supprimerAvatar');

    Route::get('/creerannonce','annonceController@create');
});

Route::get('/resetpasswordpart1','ResetPasswordController@afficherEnterMail');
Route::post('/resetpassword','ResetPasswordController@resetPasswordFindMail');
Route::get('/resetpasswordpart2','ResetPasswordController@afficherConfirmCode');
Route::post('/verifcode','ResetPasswordController@resetPasswordVerifCode');
Route::get('/resetpasswordpart3','ResetPasswordController@afficherChangerPassword');
Route::post('/changerpassword','ResetPasswordController@resetPasswordChangerPassword');


Route::resource('/Annonces','annonceController');
Route::get('/Annonces/{$id}/commander',function(){
    return view('annonce.commander{$id}');
});
Route::get('/Annonces/{$id}','annonceController@show');

Route::get('/a propos',function (){
    return view('a propos');
});



