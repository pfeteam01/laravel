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
//----------------------------------------------------------------------------------------------------------------//
Route::get('/inscription','UserRegisterController@afficherInscription');;//??
Route::post('/inscription','UserRegisterController@creerUser');;//inscription.blade.php->Inscription
Route::get('/confirm/{id}/{token}','UserRegisterController@confirmer');;//emails/register.blade.php->ValiderMonCompte
//----------------------------------------------------------------------------------------------------------------//
Route::get('/connexion','UserLoginController@afficherConnexion');;//??
Route::post('/connexion','UserLoginController@connect');;//connexion.blade.php->Login
//----------------------------------------------------------------------------------------------------------------//
Route::get('/profil','UserProfilController@afficherProfil');;//connexion.blade.php->Login
Route::get('/deconnexion','UserProfilController@deconexion');;//profil.blade.php
Route::get('/modifierprofil','UserProfilController@afficherModifierProfil');;//profil.blade.php
Route::post('/modifierprofil','UserProfilController@traitementmodifprofil');;//modifprofil.blade.php
Route::get('/modifierprofil/supprimeravatar','UserProfilController@supprimerAvatar');;//modifprofil.blade.php
//----------------------------------------------------------------------------------------------------------------//
Route::get('/creerannonce','AnnonceController@create');;//profil.blade.php
Route::post('/save','AnnonceController@store');;//annonce/create.blade.php
//----------------------------------------------------------------------------------------------------------------//
Route::get('/edit/{id}', 'AnnonceController@afficherModifAnnonce');;//??
Route::get('/supprimerimageannonce/{id}', 'AnnonceController@supprimerImageAnnonce');;//annonce/modifier.blade.php
Route::post('/update','AnnonceController@updateAnnonce');;//annonce/modifier.blade.php
Route::get('/changeetat/{id}','AnnonceController@changerEtat');;//annonce/modifier.blade.php
Route::get('/supprimerannonce/{id}','AnnonceController@supprimerAnnonce');;//??
Route::get('/supprimeracteprop/{id}','AnnonceController@supprimerActeDeProp');;//annonce/modifier.blade.php
//----------------------------------------------------------------------------------------------------------------//
Route::get('/mesnotification','NotificationController@afficherNotifications');;//profil.blade.php
Route::get('/chageetatnotification/{id}','NotificationController@changerEtatNotification');;//notification.blade.php
Route::get('/supprimernotification/{id}','NotificationController@deleteNotification');;//notification.blade.php
//----------------------------------------------------------------------------------------------------------------//
Route::post('/ajouterfavoris','FavorisController@addFavoris');;//ceci est accessible par toutes les vues qui affichent la carte géographique et qui affichent les détails de l'annonce.
Route::get('/mesfavoris','FavorisController@afficherMesFavoris');;//profil.blade.php
//----------------------------------------------------------------------------------------------------------------//
Route::get('/afficherajouteralerte','AlerteController@afficherAjouterAlerte');;//??
Route::post('/ajouteralerte','AlerteController@addAlerte');;//alertes/ajouter_alerte.blade.php
//----------------------------------------------------------------------------------------------------------------//
Route::get('/affichermodifalerte/{id}','AlerteController@afficherModifierAlerte');;//alertes/afficher_mes_alertes.blade.php
Route::post('/modifieralerte/{id}','AlerteController@updateAlerte');;//alertes/modif_alerte.blade.php
Route::get('/mesalertes/{id}','AlerteController@afficherMesAlertes');;//profil.blade.php
Route::get('/changeretat/{id}','AlerteController@changerEtatAnnonce');;//alertes/afficher_mes_alertes.blade.php
Route::get('/supprimeralerte/{id}','AlerteController@supprimerAlerte');;//alertes/afficher_mes_alertes.blade.php
Route::get('/voirannoncedealerte/{id}','AnnonceController@afficherAnnonceFromAlerte');//emails/alerte_notify.blade.php
//-----------------------------------------------------------------------------------------------------------------//
Route::get('/affichercarte','UserProfilController@afficherLaCarte');;//profil.blade.php
Route::post('/find','AnnonceController@findAnnonce');;//carte.blade.php
Route::post('/afficherdetail','AnnonceController@showDetailsAnnonce');;//carte.blade.php
Route::post('/commander','AnnonceController@commanderAnnonce');;//carte.blade.php
//-----------------------------------------------------------------------------------------------------------------//
Route::get('/resetpasswordpart1','ResetPasswordController@afficherEnterMail');;//connexion.blade.php
Route::post('/resetpassword','ResetPasswordController@resetPasswordFindMail');;//resetpassword/entermail.blade.php
Route::get('/resetpasswordpart2','ResetPasswordController@afficherConfirmCode');;//resetpassword/entermail.blade.php && emails.resetpassword.blade.php
Route::post('/verifcode','ResetPasswordController@resetPasswordVerifCode');;//resetpassword/confirmcode.blade.php
Route::get('/resetpasswordpart3','ResetPasswordController@afficherChangerPassword');;//resetpassword/confirmcode.blade.php
Route::post('/changerpassword','ResetPasswordController@resetPasswordChangerPassword');;//resetpassword/changerpassword.blade.php
//----------------------------------------------------------------------------------------------------------------//
Route::get('/registerAgence','AgenceRegisterController@showAgenceRegisterForm');;//??
Route::post('/registerAgence', 'AgenceRegisterController@createAgence');;//agence/register_agence.blade.php
Route::get('/confirmermailagence/{id}','AgenceRegisterController@confirmAgenceMail');;//emails/register_agence_mail.blade.php
//----------------------------------------------------------------------------------------------------------------//
Route::get('/loginagence', 'AgenceLoginController@showAgenceLoginForm');;//??
Route::post('/loginAgence', 'AgenceLoginController@loginAgence');;//agence/login_agence.blade.php
//----------------------------------------------------------------------------------------------------------------//
Route::get('/profilAgence','AgenceProfileController@showAgenceProfile');;//agence/login_agence.blade.php
Route::get('/agenceprofil_update','AgenceProfileController@showAgenceUpdateProfile');;//agence/profile_agence.blade.php
Route::post('/AgenceProfile_update','AgenceProfileController@updateAgence');;//agence/edit_profile_agence.blade.php
Route::get('/logout','AgenceProfileController@logoutAgence');;//agence/profile_agence.blade.php
//----------------------------------------------------------------------------------------------------------------//
Route::get('/deleteavataragence','AgenceProfileController@deleteAvatarAgence');;//agence/profile_agence.blade.php
Route::get('/deletebackgroundagence','AgenceProfileController@deleteBackgroundAgence');;//agence/profile_agence.blade.php
//----------------------------------------------------------------------------------------------------------------//
Route::get('/resetpasswordagencepart1','ResetPasswordAgenceController@afficherEnterMail');;//agence/login_agence.blade.php
Route::post('/resetpasswordagence','ResetPasswordAgenceController@resetPasswordFindMail');;//resetpasswordagence/entermail.blade.php
Route::get('/resetpasswordagencepart2','ResetPasswordAgenceController@afficherConfirmCode');;//emails/reset_password_agence_mail.blade.php && resetpasswordagence/entermail.blade.php
Route::post('/verifcodeagence','ResetPasswordAgenceController@resetPasswordVerifCode');;//resetpasswordagence/confirmcode.blade.php
Route::get('/resetpasswordagencepart3','ResetPasswordAgenceController@afficherChangerPassword');;//resetpasswordagence/confirmcode.blade.php
Route::post('/changerpasswordagence','ResetPasswordAgenceController@resetPasswordChangerPassword');;//resetpasswordagence/changerpassword.blade.php
//----------------------------------------------------------------------------------------------------------------//
