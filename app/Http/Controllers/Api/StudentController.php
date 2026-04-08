<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Personnel;
use App\Models\AdminRoleUser;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\Parametreglobaux;
use App\Models\Personnelmatiere;
use App\Models\Positionpersonnel;
use App\Models\Etablissementannee;
use App\Models\ApiResponse;
use App\Models\ApiOperator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Input;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\ValidationException;

use Flash;
use Response;
use Mail;
use PdfReport;
use DB;
use Redirect;

use Validator;
use Barryvdh\DomPDF\Facade as PDF;

class StudentController extends Controller
{
    protected $params = [];
    protected $annee_scolaire_id = [];

    public function __construct()
    {
//        $this->params = \App\Models\Parametreglobaux::findOrFail(1);
  //      $this->annee_scolaire_id = $this->params->anneescolaires_id;
    //    $this->year = '2425';
    }

    public function index()
    {
        return response()->json([
            "status" => 200,
            "response" => "success",
            "message" => "Bienvenue sur l'api METFPA DEEP v1.",
            "data" => []
        ]);
    }

    public function student (Request $request)
    {
        $query = [];
        $request_headers = $this->_getHeaders();
        // print_r($request_headers);
        // Vérifier si l'en-tête Authorization est présent
        if (
            ! isset($request_headers['AUTHORIZATION'])
        ) {
            return response()->json([
                "status" => 400,
                "authorization" => $authorization,
                "response" => "failure",
                'message' => 'En-tête Authorization manquante.',
                "data" => []
            ]);
        } else {
            $authorization = $request_headers['AUTHORIZATION'];
            $checker = $this->_checker($authorization);
			// 
            if ($checker) {
				// 
                $operator = $this->_operator($authorization);
				// Traitement des données recues
                try {
					//
                    $validator = $request->validate([
						'matricule' => 'required',
						'libelle_dr' => 'required',
						'libelle_dd' => 'required',
						'ordre_ens' => 'required',
						'code_etab' => 'required',
						'libelle_etab' => 'required',
						'nom' => 'required',
						'prenoms' => 'required',
						'genre' => 'required',
						'date_naissance' => 'required',
						'Lieu_naissance' => 'required',
						'diplome' => 'required',
						'filiere' => 'required',
						'niveau' => 'required',
						'statut_affectation' => 'required',
						'statut_inscription' => 'required',
						'statut_validation' => 'required',
						'redoublant' => 'required',
						'rejet' => 'required',
					]);
					
					// Sauvegarde de la réponse de l'opérateur
					if($query = ApiResponse::insert([
						'sender' => $operator,
						'code' => $request['matricule'],
						'data' => json_encode($request->all()),
						'date' => date('Y-m-d'),
						'time' => date('H:i:s')
					])) {
						return response()->json([
							"status" => 200,
							"response" => "success",
							"authorization" => $authorization,
							"message" => "L'enregistrement des données à réussie.",
							"data" => $query
						]);
					} else {
						return response()->json([
							"status" => 400,
							"response" => "failure",
							"authorization" => $authorization,
							"message" => "L'enregistrement des données à échoué.",
							"data" => $query
						]);
					}
                } catch (ValidationException $e) {
                    // return response()->json($e->errors(), 422);
                    return response()->json([
                        "status" => 422,
                        "authorization" => $authorization,
                        "response" => "failure",
                        "message" => $request->all(),
                        "data" => $e->errors()
                    ]);
                }
                return response()->json([
                    "status" => 200,
                    "authorization" => $authorization,
                    "response" => "success",
                    "message" => "Welcome.",
                    "data" => []
                ]);
            } else {
                return response()->json([
                    "status" => 400,
                    "authorization" => $authorization,
                    "response" => "failure",
                    "message" => "Erreur: Authentification échouée.",
                    "data" => []
                ]);
            }
        }
    }

    public function test()
    {
        $url = "https://enquete-deep.cpntic.com/api/student";

        $action = null;
        $status = '';
        $exception = '';
        $data = '';

        $timeStamp = $this->_timestamp();
        // echo $timeStamp;
        $opId = '45843';
        $plainPass = '76ha8';
        $pass = $opId . $plainPass . $timeStamp;
        // echo $pass;
        $opPassword = MD5($pass);

        // Paramètres à inclure dans le corps de la requête
        $data_json = json_encode([
            'matricule' => '22558877U',
            'reference' => 21,
            'idtransaction' => '',
            'operateur' => 'EDIATTA',
            'montantpaye' => 10000,
            'datepaiement' => strtotime(date('Y-m-d')),
        ]);
        // print_r($data_json);

		echo "opId='$opId',opPassword='$opPassword',timeStamp='$timeStamp'";
        $headers = [
            "Content-Type: application/json",
            "Authorization: AUTH opId='$opId',opPassword='$opPassword',timeStamp='$timeStamp'",
        ];
        // print_r($headers);

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Désactiver la vérification SSL
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            return response()->json([
                "status" => curl_getinfo($ch, CURLINFO_HTTP_CODE),
                "response" => "failure",
                "message" => "",
                "data" => []
            ]);
        } else {
            return response()->json([
                "status" => curl_getinfo($ch, CURLINFO_HTTP_CODE),
                "response" => "success",
                "message" => "",
                "data" => json_decode($result)
            ]);
        }

        curl_close($ch);
    }

    private function _data($id)
    {
        $query = [];

        if ($query) {
            return [

			];
        } else {
            return [];
        }
    }

    private function _code()
    {
        return MD5('#' . $this->_timestamp() . '@' . $this->year . '@' . $this->_timestamp() . '#');
    }

    private function _reference($id, $reference)
    {
        // return Elevesinscrit::where('id', $id)->update(['reference' => $reference != null ? $reference : $this->_code()]);
    }

    private function _convert_date($date)
    {
        $array = explode('/', $date);
        return count($array) == 3 ? $array[2] . '-' . $array[1] . '-' . $array[0] : null;
    }

    private function _schools($code)
    {
        $item = Etablissement::where('codeetablissement', $code)->first();
        if ($item) {
            return $item->id;
        } else {
            // return Classe::insert([
            //     'libelleclasse' => $label
            // ]);
            return null;
        }
    }

    private function _levels($label)
    {
        $item = Classe::where('libelleclasse', $label)->first();
        if ($item) {
            return $item->id;
        } else {
            return Classe::insert([
                'libelleclasse' => $label
            ]);
        }
    }

    private function _classes($label)
    {
        $item = Groupe::where('libellegroupe', $label)->first();
        if ($item) {
            return $item->id;
        } else {
            return Groupe::insert([
                'libellegroupe' => $label
            ]);
        }
    }

    private function _timestamp()
    {
        // Obtenir la date au format 'YYYYMMDDHHMMSS'
        $datetime = date('YmdHis');
        // Obtenir les millisecondes
        $milliseconds = substr(microtime(), 2, 3);
        // Combiner le tout
        return $datetime . $milliseconds;
    }

    private function _get_field_by($table, $field, $value, $key)
    {
        $item = DB::table($table)->where($field, $value)->first();
        if ($item) {
            return $item->{$key};
        } else {
            if ($id = DB::table($table)->insert([
                $field => $value
            ])) {
                return $id;
            } else {
                return null;
            }
        }
    }

    // Fonction pour obtenir les en-têtes de la requête
    private function _getHeaders()
    {
        $headers = [];
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) === 'HTTP_') {
                $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', substr($key, 5))));
                $headers[$header] = $value;
            }
        }
        return $headers;
    }

    // Fonction pour vérifier l'autorisation
    private function _checker($authorization)
    {
        $pass = '';
        $result = false;

        $arr_1 = explode(' ', str_replace('"', '', $authorization));
        $arr_2 = count($arr_1) == 2 ? explode(',', $arr_1[1]) : [];

        $param_1 = count($arr_2) == 3 ? explode('=', $arr_2[0]) : '';
        $param_2 = count($arr_2) == 3 ? explode('=', $arr_2[1]) : '';
        $param_3 = count($arr_2) == 3 ? explode('=', $arr_2[2]) : '';

        $code  = count($param_1) == 2 ? str_replace("'", "", $param_1[1]) : '';
        $token = count($param_2) == 2 ? str_replace("'", "", $param_2[1]) : '';
        $time  = count($param_3) == 2 ? str_replace('"', '', str_replace("'", "", $param_3[1])) : '';

        if ($user = ApiOperator::where('api_code', $code)->first()) {
            $pass = $user->api_code . $user->api_pass . $time;
            $md5 = MD5($pass);
            if ($arr_1[0] == 'AUTH' && $token == $md5) {
                $result = true;
            }
        }

        return $result;
    }

    // Fonction pour vérifier l'autorisation
    private function _operator($authorization)
    {
        $pass = '';
        $result = null;

        $arr_1 = explode(' ', str_replace('"', '', $authorization));
        $arr_2 = count($arr_1) == 2 ? explode(',', $arr_1[1]) : [];

        $param_1 = count($arr_2) == 3 ? explode('=', $arr_2[0]) : '';
        $param_2 = count($arr_2) == 3 ? explode('=', $arr_2[1]) : '';
        $param_3 = count($arr_2) == 3 ? explode('=', $arr_2[2]) : '';

        $code  = count($param_1) == 2 ? str_replace("'", "", $param_1[1]) : '';
        $token = count($param_2) == 2 ? str_replace("'", "", $param_2[1]) : '';
        $time  = count($param_3) == 2 ? str_replace('"', '', str_replace("'", "", $param_3[1])) : '';

        if ($user = ApiOperator::where('api_code', $code)->first()) {
            // $pass = $user->api_code . $user->api_pass . $time;
            // $md5 = MD5($pass);
            // if ($arr_1[0] == 'AUTH' && $token == $md5) {
                $result = $user->name;
            // }
        }

        return $result;
    }
}
