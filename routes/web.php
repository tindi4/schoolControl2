<?php

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

//Retourner la vue d'accueil
Route::get('/', 'SCControler@signIn'); // ouverture interface de connexion
Route::get('/loginInterface/{id}', 'SCControler@openInterface')->where('id', '[0-9]+'); // Si identifiant bon ouverture du compte

//Verification de l'informatuion pour faire connecter l'utilisateur
Route::post('/loginInterface/check_login', 'SCControler@checkLogin'); //Requete pour verification identifiant
Route::post('/api/createPerson', 'personControler@savePerson'); //Requete enregistrement professeur

//Requete par rapport aux eleve
Route::post('/loginInterface/listStudent', 'GetStudentController@getStudentList'); //Requete pour recuperer la list d'etudiant

//Reqquette pour recuperer le nombre d'enegistrement de note precedent pour une matiere donnee
Route::post('/loginInterface/get-passe-save', 'NotesController@getNoteNb');

//Requette pour enregistrer les notes
Route::post('/loginInterface/sendNotes', 'NotesController@saveNote');
