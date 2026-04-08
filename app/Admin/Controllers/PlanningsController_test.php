<?php

namespace App\Admin\Controllers;

use App\Models\{
    Parametresglobaux,
    Planning,
    Personnel,
    Etablissement,
    Etablissementannee,
    Classe,
    Discipline,
    Personnelannee,
    AdminUser,
    AdminRole,
    AdminRoleUser
};
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    Redirect,
    DB,
};
use DatePeriod;
use DateTime;
use DateInterval;
use Response;

class PlanningsController extends Controller
{
    /**
     * Affiche la liste des emplois du temps.
     *
     * @param Content $content
     * @param Request $request
     * @return Response
     */
    public function index(Content $content, Request $request)
    {
        $utilisateurs_id = Auth::guard('admin')->user()->id;
        $role_id = AdminRoleUser::where('user_id', $utilisateurs_id)->value('role_id');

        // Récupération de l'année scolaire et de l'établissement
        $anneescolaires_id = Parametresglobaux::findOrFail(1)->anneescolaires_id;
        $etablissement_id = session('etablissementchoisi');

        $EtabAnnee = Etablissementannee::where('anneescolaires_id', $anneescolaires_id)
            ->where('etablissements_id', $etablissement_id)
            ->first();

        if (!$EtabAnnee) {
            return redirect()->to('https://enquete-deep.cpntic.com/admin/etablissements2');
        }

        $plannings = Planning::where('etablissementannees_id', $EtabAnnee->id)->get();

        $lesetablissements = array();
        $etablissementannees = Etablissementannee::join('etablissements', 'etablissements.id', '=', 'etablissementannees.etablissements_id')
            ->join('anneescolaires', 'anneescolaires.id', '=', 'etablissementannees.anneescolaires_id')
            ->select('etablissementannees.id', 'etablissements.denominationetab', 'anneescolaires.libelleanneescolaire')
            ->where('etablissementannees.id', '=', $EtabAnnee->id)
            ->get();
        foreach ($etablissementannees as $etablissementannee) {
            $lesetablissements[$etablissementannee->id] = $etablissementannee->libelleanneescolaire . ' - ' . $etablissementannee->denominationetab;
        }
        $lesdisciplines = Discipline::pluck('libellediscipline', 'id');
        $lesclasses = Classe::where('etablissementannees_id', $EtabAnnee->id)->pluck('denominationclasse', 'id');
        $mesclasses = Classe::where('etablissementannees_id', $EtabAnnee->id)->get();

        $lespersonnels = array();
        $personnels = Personnelannee::where('etablissementannees_id', '=', $EtabAnnee->id)
            ->join('personnels', 'personnelannees.personnels_id', '=', 'personnels.id')
            ->get();
        foreach ($personnels as $personnel) {
            $lespersonnels[$personnel->id] = $personnel->matricule . " " . $personnel->nom . " " . $personnel->prenoms;
        }

        return $content
            ->header('EMPLOI DU TEMPS')
            ->body(
                view('calendrier.index')
                    ->with('etablissement_id', $EtabAnnee->id)
                    ->with('etablissements', $lesetablissements)
                    ->with('plannings', $plannings)
                    ->with('classes', $lesclasses)
                    ->with('mesclasses', $mesclasses)
                    ->with('professeurs', $lespersonnels)
                    ->with('disciplines', $lesdisciplines)
            );
    }

    /**
     * Récupère une liste de dates entre deux dates.
     *
     * @param string|null $debut
     * @return array
     */
    public function lesdates($debut = null)
    {
        $periode = DB::table('parametresglobaux')
            ->join('anneescolaires', 'anneescolaires.id', '=', 'parametresglobaux.anneescolaires_id')
            ->where('anneescolaires_id', Parametresglobaux::findOrFail(1)->anneescolaires_id)
            ->select('anneescolaires.datedebut', 'anneescolaires.datefin')
            ->first();

        $start = $debut ?: ($periode->datedebut ?? '');
        $end = $periode->datefin ?? '';

        return array_map(fn($date) => $date->format('Y-m-d'), iterator_to_array(new DatePeriod(
            new DateTime($start),
            new DateInterval('P1D'),
            new DateTime($end)
        )));
    }

    /**
     * Met à jour un emploi du temps via une requête AJAX.
     *
     * @param Request $request
     * @return Response
     */
    public function ajaxUpdate(Request $request)
    {
        $validated = $request->validate([
            'etablissementannees_id' => 'required|integer',
            'personnels_id' => 'required|integer',
            'classes_id' => 'required|integer',
            'disciplines_id' => 'required|integer',
            'datedebut' => 'required|date',
            'datefin' => 'required|date',
        ]);

        if ($request->id == 0) {
            $mesdates = $this->lesdates($validated['datedebut']);
            foreach ($mesdates as $madate) {
                if (date('w', strtotime($madate)) == date('w', strtotime($validated['datedebut']))) {
                    $donnees = array_merge($validated, [
                        'datedebut' => "{$madate} " . date('H:i:s', strtotime($validated['datedebut'])),
                        'datefin' => "{$madate} " . date('H:i:s', strtotime($validated['datefin'])),
                    ]);
                    Planning::create($donnees);
                }
            }
        } else {
            $planning = Planning::find($request->id);
            if ($planning) {
                $planning->update($validated);
            }
        }
        return response()->json(['success' => true]);
    }

    /**
     * Supprime un emploi du temps ou plusieurs via une requête AJAX.
     *
     * @param Request $request
     * @return Response
     */
    public function ajaxDelete(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
            'all' => 'boolean',
            'etablissementannees_id' => 'required|integer',
            'personnels_id' => 'required|integer',
            'classes_id' => 'required|integer',
            'disciplines_id' => 'required|integer',
            'datedebut' => 'required|date',
            'datefin' => 'required|date',
        ]);

        if ($request->all) {
            $mesdates = $this->lesdates($validated['datedebut']);
            foreach ($mesdates as $madate) {
                if (date('w', strtotime($madate)) == date('w', strtotime($validated['datedebut']))) {
                    Planning::where([
                        'etablissementannees_id' => $validated['etablissementannees_id'],
                        'personnels_id' => $validated['personnels_id'],
                        'classes_id' => $validated['classes_id'],
                        'disciplines_id' => $validated['disciplines_id'],
                        'datedebut' => "{$madate} " . date('H:i:s', strtotime($validated['datedebut'])),
                        'datefin' => "{$madate} " . date('H:i:s', strtotime($validated['datefin'])),
                    ])->delete();
                }
            }
        } else {
            Planning::where('id', $validated['id'])->delete();
        }

        return response()->json(['success' => true]);
    }

    /**
     * Retourne une liste d'événements filtrés.
     *
     * @param Request $request
     * @return Response
     */
    public function getFilteredEvents(Request $request)
    {
        try {
            // Construire la requête en ajoutant les filtres seulement si requis
            $query = Planning::query()->where('etablissementannees_id', session('etablissementchoisi'));

            foreach (['etablissementannees_id', 'personnels_id', 'classes_id', 'disciplines_id'] as $filter) {
                if ($request->filled($filter)) {
                    $query->where($filter, $request->$filter);
                }
            }

            $events = $query->get()->map(function ($planning) {
                // Vérification de la présence des relations pour éviter les erreurs nulles
                $etablissement = $planning->etablissementannee->etablissement ?? null;
                $discipline = $planning->discipline ?? null;
                $personnel = $planning->personnel ?? null;
                $classe = $planning->classe ?? null;

                if (!$etablissement || !$discipline || !$personnel || !$classe) {
                    Log::error("Relation manquante dans les événements de planning", [
                        'planning_id' => $planning->id,
                        'etablissement' => $etablissement,
                        'discipline' => $discipline,
                        'personnel' => $personnel,
                        'classe' => $classe
                    ]);
                    return null; // Passer cet événement
                }

                return [
                    'id' => $planning->id,
                    'title' => "Etablissement: {$etablissement->denominationetab} - " .
                        "Discipline: {$discipline->libellediscipline} - " .
                        "Professeur: {$personnel->nom} - " .
                        "Classe: {$classe->denominationclasse}",
                    'start' => $planning->datedebut,
                    'end' => $planning->datefin,
                ];
            })->filter(); // Supprimer les événements nulls

            return response()->json($events->values()); // Remettre les index à zéro après filtre
        } catch (\Exception $e) {
            // Enregistrement d'erreurs si un problème survient
            Log::error("Erreur lors du chargement des événements", ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Erreur lors du chargement des événements'], 500);
        }
    }
}
