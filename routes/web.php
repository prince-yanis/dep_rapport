<?php

use Illuminate\Http\Request;
use App\Models\Itemscontrole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\GeneratepdfController;
use App\Http\Controllers\InscriptionController;

use App\Models\AdminUser;
use App\Models\AdminRoleUser;
use App\Models\Etablissement;

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
    return view('index');
});


// Envvoie de demande par un postulant
// Route::resource('/inscription', InscriptionController::class);
Route::resource('/chargement_planning', InscriptionController::class);
Route::get('/planning' , [PlanningController::class,'index']);
Route::post('miseajourplanning',[PlanningController::class,'ajaxUpdate']);

Route::get('/missionpdf/{id}', [GeneratepdfController::class, 'missionpdf']);

Route::get('/rapportrentre/{id}', [GeneratepdfController::class, 'rapport_rentre']);

Route::get('/rapportsemestre1/{id}', [GeneratepdfController::class, 'rapport_sem1']);

Route::get('/rapportsemestre2/{id}', [GeneratepdfController::class, 'rapport_sem2']);

Route::get('/ficheobservation/{id}', [GeneratepdfController::class, 'observation']);

Route::get('/emploisdutemps/{id}', [GeneratepdfController::class, 'emploi_du_temps']);

//Route::post('miseajourplanning',['as'=>'miseajourplanning','uses' => 'PlanningController@ajaxUpdate']);
//Route::get('planning',['as'=>'planning', 'uses'=> 'PlanningController@index'] );
Route::get('/api/itemscontrole', function (Request $request) {
    $sousrubriquecontroleId = $request->get('q');  // The 'q' parameter will be passed automatically by Laravel Admin's dependent select
    $items = Itemscontrole::where('sousrubriquecontrole_id', $sousrubriquecontroleId)
        ->get(['id', 'libelleitems']);
    return $items->pluck('libelleitems', 'id');
});

// Route::get('/codes', function () {
//     $values = AdminRoleUser::select('admin_role_users.*', 'admin_users.*')
// 		->join('admin_users', 'admin_role_users.user_id', '=', 'admin_users.id')
// 		->where('role_id', 2)->get();
	
// 	foreach ($values as $value) {
// 		// echo  $value->id .' - '. formaterMot($value->name) .' - '. formaterMot($value->username) . '<br>';
// 		echo  $value->id .' - '. ($value->name) .' - '. formaterMot($value->name) . '<br>';
// 		AdminUser::where('id', $value->id)->update([
// 			'username' => formaterMot($value->name),
// 			'name' => formaterMot($value->name),
// 		]);
// 	}
	
// 	$values = Etablissement::get();
// 	foreach ($values as $value) {
// 		echo  $value->id .' - '. $value->code .' - '. formaterMot($value->code) . '<br>';
// 		Etablissement::where('id', $value->id)->update([
// 			'code' => formaterMot($value->code),
// 		]);
// 	}
// });

// function formaterMot($mot) {
//     $longueur = strlen($mot);
//     if ($longueur < 6) {
//         $zerosAAjouter = 6 - $longueur;
//         $motFormate = str_repeat('0', $zerosAAjouter) . $mot;
//     } else {
//         $motFormate = $mot;
//     }
//     return $motFormate;
// }