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

Route::get('/inscription','UserController@afficherInscription');
Route::post('/inscription','UserController@creerUser');
Route::get('/confirm/{id}/{token}','UserController@confirmer');

Route::get('/connexion','AuthController@afficherConnexion');
Route::post('/connexion','AuthController@connect');

Route::group([
    'middleware' => 'App\Http\Middleware\Authentification',
],function (){
    Route::get('/profil','ProfilController@afficherProfil');
    Route::get('/deconnexion','ProfilController@deconexion');
    Route::get('/modifierprofil','ProfilController@afficherModifierProfil');
    Route::post('/modifierprofil','ProfilController@traitementmodifprofil');
    Route::get('/modifierprofil/supprimeravatar','ProfilController@supprimerAvatar');

    Route::get('/creerannonce','AnnonceController@create');
    Route::post('/save','AnnonceController@store');
    Route::get('/save','AnnonceController@store');

    Route::get('/edit/{id}', 'AnnonceController@afficherModifAnnonce');
    Route::post('/supprimerimageannonce', 'AnnonceController@supprimerImageAnnonce');
    Route::post('/update','AnnonceController@updateAnnonce');
    Route::get('/update','AnnonceController@updateAnnonce');
    Route::get('/changeetat/{id}','AnnonceController@changerEtat');
    Route::get('/supprimerannonce/{id}','AnnonceController@supprimerAnnonce');
    Route::get('/supprimeracteprop/{id}','AnnonceController@supprimerActeDeProp');

    Route::get('/mesnotification','NotificationController@afficherNotifications');
    Route::get('/chageetatnotification/{id}','NotificationController@changerEtatNotification');
    Route::get('/supprimernotification/{id}','NotificationController@deleteNotification');

    Route::get('/ajouterfavoris','FavorisController@addFavoris');
    Route::post('/ajouterfavoris','FavorisController@addFavoris');
    Route::get('/mesfavoris','FavorisController@afficherMesFavoris');

    Route::get('/afficherajouteralerte','AlerteController@afficherAjouterAlerte');
    Route::post('/ajouteralerte','AlerteController@addAlerte');

    Route::get('/affichermodifalerte/{id}','AlerteController@afficherModifierAlerte');
    Route::post('/modifieralerte/{id}','AlerteController@updateAlerte');
    Route::get('/mesalertes/{id}','AlerteController@afficherMesAlertes');
    Route::get('/changeretat/{id}','AlerteController@changerEtatAnnonce');
    Route::get('/supprimeralerte/{id}','AlerteController@supprimerAnnonce');
    Route::get('/voirannoncedealerte/{id}','AnnonceController@afficherAnnonceFromAlerte');
});

Route::get('/affichercarte','ProfilController@afficherLaCarte');
Route::post('/find','AnnonceController@findAnnonce');
Route::get('/find','AnnonceController@findAnnonce');
Route::post('/afficherdetail','AnnonceController@showDetailsAnnonce');
Route::get('/afficherdetail','AnnonceController@showDetailsAnnonce');
Route::get('/commander','AnnonceController@commanderAnnonce');
Route::post('/commander','AnnonceController@commanderAnnonce');

Route::get('/resetpasswordpart1','ResetPasswordController@afficherEnterMail');
Route::post('/resetpassword','ResetPasswordController@resetPasswordFindMail');
Route::get('/resetpasswordpart2','ResetPasswordController@afficherConfirmCode');
Route::post('/verifcode','ResetPasswordController@resetPasswordVerifCode');
Route::get('/resetpasswordpart3','ResetPasswordController@afficherChangerPassword');
Route::post('/changerpassword','ResetPasswordController@resetPasswordChangerPassword');



Route::resource('/Annonces','AnnonceController');
Route::get('/Annonces/{$id}','AnnonceController@show');
Route::post('/Annonce/{id}/edit','AnnonceController@update') ;

Route::get('/a propos',function (){
    return view('a propos');
});
