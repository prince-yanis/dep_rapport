<?php

namespace App\Admin\Controllers;


use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use App\Models\{
    Classe,
    Etablissement,
    Apprenant,
    Apprenantannee,
    Etablissementannee,
    Statutapprenant,
	Extraction
};

use App\Models\AdminRole;
use App\Models\AdminUser;
use App\Models\Personnel;
use App\Models\AdminRoleUser;
use App\Models\Anneescolaire;
use App\Models\Filiereenseigne;
use App\Models\Parametreglobaux;
use App\Models\Personnelmatiere;
use App\Models\Positionpersonnel;

use Encore\Admin\Layout\Content;
use Doctrine\DBAL\Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\MessageBag;
use Encore\Admin\Controllers\AdminController;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Illuminate\Support\Facades\DB;

class InsertionetablissementController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Admission controller';
    protected $current_year = 0;

    /**
     * Constructor.
     */
    public function __construct() {}

    /**
     * G�n�rer les salaires.
     *
     * @param Content $content
     * @return Content
     */
    public function insertions(Content $content)
    {
        return $content
            ->header('Insertion')
            ->description('Insertion des établissements dans la base')
            ->body($this->form_2());
    }

    /**
     * Formulaire de g�n�ration des salaires.
     *0.
     * @return Form
     */
    protected function form_2()
    {
        $form = new Form(new Etablissement);
        $form->file('insertion_file', __('Fichier a importer'));
        $form->setAction('insertion');
        return $form;
    }

    public function insertion(Request $request)
    {
        //        if ($request->get('type_file') == 'csv') {

        $message = '';

        try {
            // $anneescolaire = Parametreglobaux::find(1)->anneescolaires_id;

            $fichier = $_FILES['insertion_file']['tmp_name'];

            $separateur = ';';

            $file = new \SplFileObject($fichier);
            $file->setFlags(\SplFileObject::READ_CSV | \SplFileObject::SKIP_EMPTY);
            $file->setCsvControl($separateur);
            // $anneescolaires_id = 1;
            $tab_champs = $file->current();
            $champs_insert = array_fill(0, count($tab_champs), '?');
            $champs_insert = implode(',', $champs_insert);

            $file->next();

            while ($row = $file->current()) {

                $DR = (int) $row[0]; // Conversion en entier
                $ordre_enseignement =  1;
                $diplomeprepares =  1;
                $code = (int)  $row[3];
                // $libelle = utf8_encode($row[4]);
                $libelle = utf8_encode($row[4]);
                // $localisation =  $row[5];
                $localisation = utf8_encode($row[5]);
                // $serie =  $row[6];
                $serie = (int) $row[6]; // Vérifier que la série est présente et convertir en entier
                $contact_se =  utf8_encode($row[7]);
                $contact_de =  utf8_encode($row[8]);
                $contact_cf =  utf8_encode($row[9]);
                // $contact_serfe =  utf8_encode($row[10]);
                $contact_fond =  utf8_encode($row[10]);
                $courriel_1 =   utf8_encode($row[11]);
                $courriel_2 =  utf8_encode($row[12]);
                $anneescolaires_id = session('anneescolaireactuelle');

                $etablissement = Etablissement::where('code', '=', $code)->first();

                if (!$etablissement) {
                    $etablissement = Etablissement::create([
                        'denominationetab' => $libelle,
                        'code' => $code,
                        'directiondepartementales_id' => $DR,
                        'ordre_enseignement_id' => $ordre_enseignement,
                        'contact_se' => $contact_se,
                        'contact_de' => $contact_de,
                        'contact_cf' => $contact_cf,
                        'contact' => $contact_fond,
                        'email' => $courriel_1,
                    ]);
                    $etablissement_id = $etablissement->id;

                    // Create an validateur account
                    if (!AdminUser::where([
                        ['username', '=', $code],
                    ])->exists()) {
                        $rubric = new AdminUser([
                            'username' => $code,
                            'name' => $code,
                            'idEtab' => $etablissement_id,
                            'password' => \Hash::make('00000000'),
                        ]);
                        if ($rubric->save()) {
                            $query = new AdminRoleUser([
                                'user_id' => $rubric->id,
                                'role_id' => AdminRole::where('slug', 'etablissements')->firstOrFail()->id,
                            ]);
                            $query->save();
                        }
                    }
                } else {
                    $etablissement_id = $etablissement->id;
                    $etablissement->update([
                        'denominationetab' => $libelle,
                        'localisation' => $localisation,
                        'contact_se' => $contact_se,
                        'contact_de' => $contact_de,
                        'contact_cf' => $contact_cf,
                        'contact' => $contact_fond,
                        'email' => $courriel_1,
                        'email_2' => $courriel_2,
                    ]);
                }

                $etablissementinsere = Etablissement::find($etablissement_id);
                $existingAnnee = Etablissementannee::where('anneescolaires_id', $anneescolaires_id)
                    ->where('etablissements_id', $etablissement_id)
                    ->first();
                if ($existingAnnee) {
                    $existingAnnee->update([
                        'anneescolaires_id' => $anneescolaires_id,
                        'etablissements_id' => $etablissement_id

                    ]);
                } else {
                    // Vérifiez si Etablissement-Année n'existe pas
                    $existingAnnee = Etablissementannee::create([
                        'anneescolaires_id' => $anneescolaires_id,
                        'etablissements_id' => $etablissement_id
                    ]);
                }

                $etablissementannee_id = $existingAnnee->id;
                $existingFiliere = Filiereenseigne::where('filieres_id', $serie)
                    ->where('etablissementannees_id', $etablissementannee_id)
                    ->first();
                if (!$existingFiliere) {
                    Filiereenseigne::create([
                        'etablissementannees_id' => $etablissementannee_id,
                        'filieres_id' => $serie,
                        'diplomeprepares_id' => $diplomeprepares
                    ]);
                }
                // if (!is_null($serie)) {
                //     $existingFiliere = Filiereenseigne::where('filieres_id', $serie)
                //         ->where('etablissementannees_id', $etablissementannee_id)
                //         ->first();

                //     if (!$existingFiliere) {
                //         Filiereenseigne::create([
                //             'etablissementannees_id' => $etablissementannee_id,
                //             'filieres_id' => $serie, // Assurez-vous que cette valeur est non vide
                //             'diplomeprepares_id' => $diplomeprepares
                //         ]);
                //     }
                // } else {
                //     $message .= "La filière est manquante ou incorrecte pour l'établissement avec le code: {$code}.";
                // }

                $file->next();
            }

            $message .= 'Insertion réussie.';
            $success = new MessageBag([
                'title' => "",
                'message' => $message,
            ]);
            return back()->with(compact('success'));
        } catch (Exception $e) {
            $message .= 'Mise &acute; jour réussie.';
            $message .= $e->getMessage();
            $error = new MessageBag([
                'title' => "",
                'message' => $message,
            ]);
            return back()->with(compact('error'));
        }
    }



    /**
     * G�n�rer les salaires.
     *
     * @param Content $content
     * @return Content
     */
    public function imports(Content $content)
    {
        return $content
            ->header('Importer ')
            ->description('Insertion des établissements dans la base')
            ->body($this->form());
    }

    /**
     * Formulaire de g�n�ration des salaires.
     *0.
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Etablissement);
        $form->file('insertion_file', __('Importer le fichier'))->rules('required|mimes:xls,xlsx');
        $form->setAction('import');
        return $form;
    }

    public function import(Request $request)
    {
		ini_set('memory_limit', '-1'); // Vous pouvez ajuster la valeur selon vos besoins

		$request->validate([
            // 'classes_id' => 'required|integer',
            // 'etablissements_id' => 'required|integer',
            'insertion_file' => 'required|file|mimes:xls,xlsx',
            // 'insertion_file' => 'required|file',
        ]);

        $file = $request->file('insertion_file');
        $extension = $file->getClientOriginalExtension();

        /*
		// Appel de la fonction
		try {
			$this->readLargeExcelFile($file);
			// readLargeExcelFile('path/to/large-file.xlsx');
		} catch (Exception $e) {
			echo "Erreur : " . $e->getMessage();
		}
		*/


        try {
            $spreadsheet = IOFactory::load($file->getRealPath());
            $rows = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            $i = $j = $z = $successCount = 0;

            foreach ($rows as $index => $row) {
                if ($index === 1) continue; // Skip header row

                // Map columns to variables

                $libelle = $row['A'];
                $filiere_libelle = $row['B'];
                $diplome_libelle = $row['C'];
                $matricule = $row['D'];
                $nom = $row['E'];
                $prenoms = $row['F'];
                $genre = $row['G'];
                $niveau_libelle = $row['H'];
                $statut = $row['I'];
                $valide = $row['J'];
                $dr = $row['M'];
                // $code = $row['N'];
                $code = implode(' ', array_map(fn($word) => str_pad($word, 6, '0', STR_PAD_LEFT), explode(' ', $row['N'])));

                // $code = $row['A'];

                $etablissement = Etablissement::where('code', $code)->first();
                $anneescolaires_id = session('anneescolaireactuelle');

                if ($etablissement) {
                    $etablissement_id = $etablissement->id;
                    $etablissementannees = Etablissementannee::where('etablissements_id', $etablissement_id)
                        ->where('anneescolaires_id', $anneescolaires_id)
                        ->first();

                    if ($etablissementannees) {
                        $etablissementannees_id = $etablissementannees->id;
                        if (Etablissementannee::where('etablissements_id', $etablissement_id)->where('anneescolaires_id', $anneescolaires_id)->update([
                                'anneescolaires_id' => $anneescolaires_id,
                                'etablissements_id' => $etablissement_id,
                                'fonctionnel' => 1
                            ])
                        ) {
                            // $i++;
                        }
                    } else {
                        // Vérifiez si Etablissement-Année n'existe pas
                        $etablissementannees_id = Etablissementannee::create([
                            'anneescolaires_id' => $anneescolaires_id,
                            'etablissements_id' => $etablissement_id,
                            'fonctionnel' => 1
                        ]);
                    }

                    switch ($niveau_libelle) {
                        case '1A':
                            $niveau_libelle = 'PREMIERE ANNEE';
                            break;
                        case '2A':
                            $niveau_libelle = 'DEUXIEME ANNEE';
                            break;
                        case '3A':
                            $niveau_libelle = 'TROISIÈME ANNEE';
                            break;
                    }

                    $apprenant = \App\Models\Apprenant::where('matriculeap', $matricule)->first();
                    $diplome = \App\Models\Diplomeprepare::where('libellediplome', $diplome_libelle)->first();
                    $filiere = \App\Models\Filiere::where('libellefiliere', $filiere_libelle)->first();
                    $niveau = \App\Models\Niveau::where('libelleniveau', $niveau_libelle)->first();

                    if (
                        ! $apprenant &&
                        $diplome &&
                        $filiere &&
                        $niveau
                    ) {
                        $check = Apprenant::firstOrCreate([
                            'matriculeap' => $matricule,
                            'nom' => $nom,
                            'prenoms' => $prenoms,
                            // 'datenaissance' => $datenaissance,
                            // 'lieunaissance' => $lieunaissance,
                            // 'nationalite' => $nationalite,
                            'sexe' => $genre,
                            // 'handicap_id' => $handicap ? : null,
                        ]);

                        Apprenantannee::firstOrCreate([
                            'etablissementannees_id' => $etablissementannees_id,
                            'apprenants_id' => $check->id,
                            // 'classes_id' => $request->classes_id,
                            // 'bourses_id' => $bourse ? : null,
                            'statutapprenants_id' => $statut == 'ORIENTE' ? 4 : 5,
                            'valide' => $statut == 'VALIDE' ? 1 : 0,
                        ]);

                        $i++;
                    }

                    if (
                        ! $apprenant &&
                        ! $diplome ||
                        ! $filiere ||
                        ! $niveau
                    ) {
                        DB::table('noninseres')->insert([
                            'etablissement' => $libelle,
                            'matricule' => $matricule,
                            'nom' => $nom,
                            'prenoms' => $prenoms,
                            'genre' => $genre,
                            'code' => $code,
                            'statut' => $statut,
                            'valide' => $valide,
                            'filiere' => $filiere_libelle,
                            'niveau' => $niveau_libelle,
                            'diplome' => $diplome_libelle,
                            'dr' => $dr,
                        ]);
                    }
                    /*
					if (
						$apprenant
					) {
						Apprenantannee::
						where('etablissementannees_id', $etablissementannees_id)->
						where('apprenants_id', $apprenant->id)->
							update([
							// 'etablissementannees_id' => $etablissementannees_id,
							// 'apprenants_id' => $check->id,
							// 'classes_id' => $request->classes_id,
							// 'bourses_id' => $bourse ? : null,
							// 'statutapprenants_id' => $statut == 'ORIENTE' ? 4 : 5,
							'valide' => $statut == 'VALIDE' ? 1 : 0,
						]);
						
						$z++;
					} 					
*/
                    // Filieres

                } else {
                    // echo $code . ' KO <br>';
                    $j++;
                }
                // 
                $successCount++;
            }

            $message = "Nombre d'enregistrements réussi : $i / $z / $successCount contre $j.";
            return back()->with('success', new MessageBag(['title' => 'Succès', 'message' => $message]));
        } catch (\Exception $e) {
            $message = 'Erreur : ' . $e->getMessage();
            return back()->with('error', new MessageBag(['title' => 'Erreur', 'message' => $message]));
        }
        /*		
try {
    // Charger le fichier Excel
    $spreadsheet = IOFactory::load($file->getRealPath());
    $rows = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

    $batchSize = 1000; // Taille de lot pour traitement
    $batchData = [];
    $successCount = $i = $j = $z = 0;

    foreach ($rows as $index => $row) {
        if ($index === 1) continue; // Ignorer la ligne d'en-tête

        // Remplir les variables avec les colonnes correspondantes
        $libelle = $row['A'];
        $filiere_libelle = $row['B'];
        $diplome_libelle = $row['C'];
        $matricule = $row['D'];
        $nom = $row['E'];
        $prenoms = $row['F'];
        $genre = $row['G'];
        $niveau_libelle = $row['H'];
        $statut = $row['I'];
        $valide = $row['J'];
        $dr = $row['M'];
        $code = implode(' ', array_map(fn($word) => str_pad($word, 6, '0', STR_PAD_LEFT), explode(' ', $row['N'])));

        // Ajouter les données au lot courant
        $batchData[] = compact('libelle', 'filiere_libelle', 'diplome_libelle', 'matricule', 'nom', 'prenoms', 'genre', 'niveau_libelle', 'statut', 'valide', 'dr', 'code');

        // Traiter le lot une fois atteint la taille définie
        if (count($batchData) >= $batchSize) {
            $this->processBatch($batchData, $i, $j, $z);
            $batchData = []; // Réinitialiser le lot
        }
    }

    // Traiter les données restantes
    if (!empty($batchData)) {
        processBatch($batchData, $i, $j, $z);
    }

    $message = "Nombre d'enregistrements réussi : $i / $z / $successCount contre $j.";
    return back()->with('success', new MessageBag(['title' => 'Succès', 'message' => $message]));

} catch (\Exception $e) {
    $message = 'Erreur : ' . $e->getMessage();
    return back()->with('error', new MessageBag(['title' => 'Erreur', 'message' => $message]));
}
*/
    }

    function readLargeExcelFile($filePath, $batchSize = 1000)
    {
        $reader = new Xlsx();
        $reader->setReadDataOnly(true); // Désactive les styles pour économiser la mémoire
        $reader->setLoadSheetsOnly(['Sheet1']); // Charger uniquement une feuille si possible

        $spreadsheet = $reader->load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        $rowIndex = 0;
        $batchData = [];

        foreach ($worksheet->getRowIterator() as $row) {
            $rowIndex++;
            $rowData = [];

            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getValue();
            }

            $batchData[] = $rowData;

            // Traiter par lot
            if ($rowIndex % $batchSize === 0) {
                $this->processBatch($batchData);
                $batchData = []; // Réinitialiser le tableau
            }
        }

        // Traiter les lignes restantes
        if (!empty($batchData)) {
            $this->processBatch($batchData);
        }

        echo "Lecture terminée.";
    }

    // Fonction pour traiter les lots de données
    function processBatch($batch, &$i, &$j, &$z)
    {
        foreach ($batch as $row) {
            extract($row);

            $etablissement = Etablissement::where('code', $code)->first();
            $anneescolaires_id = session('anneescolaireactuelle');

            if ($etablissement) {
                $etablissement_id = $etablissement->id;
                $etablissementannees = Etablissementannee::where('etablissements_id', $etablissement_id)
                    ->where('anneescolaires_id', $anneescolaires_id)
                    ->first();

                // Insérer ou mettre à jour Etablissementannee
                if (!$etablissementannees) {
                    Etablissementannee::create([
                        'anneescolaires_id' => $anneescolaires_id,
                        'etablissements_id' => $etablissement_id,
                        'fonctionnel' => 1,
                    ]);
                }

                // Mapper le niveau
                switch ($niveau_libelle) {
                    case '1A':
                        $niveau_libelle = 'PREMIERE ANNEE';
                        break;
                    case '2A':
                        $niveau_libelle = 'DEUXIEME ANNEE';
                        break;
                    case '3A':
                        $niveau_libelle = 'TROISIÈME ANNEE';
                        break;
                }

                $apprenant = \App\Models\Apprenant::where('matriculeap', $matricule)->first();
                $diplome = \App\Models\Diplomeprepare::where('libellediplome', $diplome_libelle)->first();
                $filiere = \App\Models\Filiere::where('libellefiliere', $filiere_libelle)->first();
                $niveau = \App\Models\Niveau::where('libelleniveau', $niveau_libelle)->first();

                if (!$apprenant && $diplome && $filiere && $niveau) {
                    $check = Apprenant::firstOrCreate([
                        'matriculeap' => $matricule,
                        'nom' => $nom,
                        'prenoms' => $prenoms,
                        'sexe' => $genre,
                    ]);

                    Apprenantannee::firstOrCreate([
                        'etablissementannees_id' => $etablissementannees->id,
                        'apprenants_id' => $check->id,
                        'statutapprenants_id' => $statut == 'ORIENTE' ? 4 : 5,
                        'valide' => $statut == 'VALIDE' ? 1 : 0,
                    ]);

                    $i++;
                } elseif (!$diplome || !$filiere || !$niveau) {
                    DB::table('noninseres')->insert(compact('libelle', 'matricule', 'nom', 'prenoms', 'genre', 'code', 'statut', 'valide', 'filiere_libelle', 'niveau_libelle', 'diplome_libelle', 'dr'));
                    $j++;
                } else {
                    $z++;
                }
            } else {
                $j++;
            }
        }
    }

    function reccuperations()
    {
		ini_set('memory_limit', '-1'); // Vous pouvez ajuster la valeur selon vos besoins
        $rows = DB::table('extractions')->limit(10000)->get();
		
        $i = $j = $z = $successCount = 0;
// 		Extraction::chunk(1000, function ($rows) {
        $i = $j = $z = $successCount = 0;
        foreach ($rows as $index => $row) {
            if ($index === 1) continue; // Skip header row

            // Map columns to variables
            $anneescolaires_id = session('anneescolaireactuelle');
            $libelle = $row->etablissement;
            $filiere_libelle = $row->filiere;
            $diplome_libelle = $row->diplome;
            $matricule = $row->matricule;
            $nom = $row->nom;
            $prenoms = $row->prenoms;
            $genre = $row->genre;
            $niveau_libelle = $row->niveau;
            $statut = $row->statut;
            $valide = $row->valide;
            $dr = $row->dr;
            // $code = $row['N'];
            $code = implode(' ', array_map(fn($word) => str_pad($word, 6, '0', STR_PAD_LEFT), explode(' ', $row->code)));

            // $code = $row['A'];

            $etablissement = Etablissement::where('code', $code)->first();
            $anneescolaires_id = session('anneescolaireactuelle');

            if ($etablissement) {
                $etablissement_id = $etablissement->id;
                $etablissementannees = Etablissementannee::where('etablissements_id', $etablissement_id)
                    ->where('anneescolaires_id', $anneescolaires_id)
                    ->first();

                if ($etablissementannees) {
                    $etablissementannees_id = $etablissementannees->id;
                    if (Etablissementannee::where('etablissements_id', $etablissement_id)->where('anneescolaires_id', $anneescolaires_id)->update([
                            'anneescolaires_id' => $anneescolaires_id,
                            'etablissements_id' => $etablissement_id,
                            'fonctionnel' => 1
                        ])
                    ) {
                        // $i++;
                    }
                } else {
                    // Vérifiez si Etablissement-Année n'existe pas
                    $etablissementannees_id = Etablissementannee::create([
                        'anneescolaires_id' => $anneescolaires_id,
                        'etablissements_id' => $etablissement_id,
                        'fonctionnel' => 1
                    ]);
                }

                switch ($niveau_libelle) {
                    case '1A':
                        $niveau_libelle = 'PREMIERE ANNEE';
                        break;
                    case '2A':
                        $niveau_libelle = 'DEUXIEME ANNEE';
                        break;
                    case '3A':
                        $niveau_libelle = 'TROISIÈME ANNEE';
                        break;
                }

                $apprenant = \App\Models\Apprenant::where('matriculeap', $matricule)->first();
                $diplome = \App\Models\Diplomeprepare::where('libellediplome', $diplome_libelle)->first();
                $filiere = \App\Models\Filiere::where('libellefiliere', $filiere_libelle)->first();
                $niveau = \App\Models\Niveau::where('libelleniveau', $niveau_libelle)->first();

                if (
                    ! $apprenant &&
                    $diplome &&
                    $filiere &&
                    $niveau
                ) {
                    $check = Apprenant::firstOrCreate([
                        'matriculeap' => $matricule,
                        'nom' => $nom,
                        'prenoms' => $prenoms,
                        // 'datenaissance' => $datenaissance,
                        // 'lieunaissance' => $lieunaissance,
                        // 'nationalite' => $nationalite,
                        'sexe' => $genre,
                        // 'handicap_id' => $handicap ? : null,
                    ]);

                    Apprenantannee::firstOrCreate([
                        'etablissementannees_id' => $etablissementannees_id,
                        'apprenants_id' => $check->id,
                        // 'classes_id' => $request->classes_id,
                        // 'bourses_id' => $bourse ? : null,
                        'statutapprenants_id' => $statut == 'ORIENTE' ? 4 : 5,
                        'valide' => $statut == 'VALIDE' ? 1 : 0,
                    ]);

                    $i++;
                }

                if (
                    ! $apprenant &&
                    ! $diplome ||
                    ! $filiere ||
                    ! $niveau
                ) {
					/*
                    DB::table('noninseres')->insert([
                        'etablissement' => $libelle,
                        'matricule' => $matricule,
                        'nom' => $nom,
                        'prenoms' => $prenoms,
                        'genre' => $genre,
                        'code' => $code,
                        'statut' => $statut,
                        'valide' => $valide,
                        'filiere' => $filiere_libelle,
                        'niveau' => $niveau_libelle,
                        'diplome' => $diplome_libelle,
                        'dr' => $dr,
                    ]);
					*/
DB::table('noninseres')->upsert([
        [
            'etablissement' => $libelle,
            'matricule' => $matricule,
            'nom' => $nom,
            'prenoms' => $prenoms,
            'genre' => $genre,
            'code' => $code,
            'statut' => $statut,
            'valide' => $valide,
            'filiere' => $filiere_libelle,
            'niveau' => $niveau_libelle,
            'diplome' => $diplome_libelle,
            'dr' => $dr,
        ],],
    ['matricule'], // Colonnes utilisées pour déterminer l'unicité
    ['nom', 'prenoms', 'genre', 'code', 'statut', 'valide', 'filiere', 'niveau', 'diplome', 'dr'] // Colonnes à mettre à jour si elles existent
);
                }

                if (
                    $apprenant
                ) {
                    Apprenantannee::where('etablissementannees_id', $etablissementannees_id)->where('apprenants_id', $apprenant->id)->update([
                            // 'etablissementannees_id' => $etablissementannees_id,
                            // 'apprenants_id' => $check->id,
                            // 'classes_id' => $request->classes_id,
                            // 'bourses_id' => $bourse ? : null,
                            // 'statutapprenants_id' => $statut == 'ORIENTE' ? 4 : 5,
                            'valide' => $statut == 'VALIDE' ? 1 : 0,
                        ]);

                    $z++;
                }
                // Filieres
            } else {
                // echo $code . ' KO <br>';
                $j++;
            }
            // 
            $successCount++;
        }
//		});

        $message = "Nombre d'enregistrements réussi : $i / $z / $successCount contre $j.";
        return back()->with('success', new MessageBag(['title' => 'Succès', 'message' => $message]));
    }
}
