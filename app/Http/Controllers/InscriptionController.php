<?php

namespace App\Http\Controllers;

use App\Models\AdminRole;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Models\AdminRoleUser;
use App\Models\Etablissement;
use App\Models\Fonctionpersonnel;
use App\Models\Fondateur;
use App\Models\Fondateuretablissement;
use App\Models\Participant;
use App\Models\Sessionformation;

class InscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etablissements = Etablissement::all();
        $sessions = Sessionformation::all();
        $fonctions = Fonctionpersonnel::all();

        // Ajout du nombre de participants à chaque session
        foreach ($sessions as $key => $item) {
            $sessionId = $item->id;
            $sessions[$key]->participants = Participant::where('sessionformations_id', $sessionId)->count();

            $capacite = Sessionformation::select('capacite')->find($sessionId)->capacite;

            $sessions[$key]->capacite = $capacite;
        }


        return view('inscription', [
            'sessions' => $sessions,
            'etablissements' => $etablissements,
            'fonctions' => $fonctions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'contact_2' => 'required',
            'etablissements_id' => 'required',
            'fonctionpersonnels_id' => 'required',
            'sessionformations_id' => 'required',
        ]);

        // Vérifier si l'email, le contact, ou contact_2 existent déjà dans la base de données
        if (Fondateur::where('email', $request->email)->exists()) {
            return redirect('/inscription')->with(['message' => 'L\'email est déjà attribué à un participant.']);
        }

        if (Fondateur::where('contact', $request->contact)->exists()) {
            return redirect('/inscription')->with(['message' => 'Le Numéro de téléphone est déjà attribué à un participant.']);
        }

        if (Fondateur::where('contact_2', $request->contact_2)->exists()) {
            return redirect('/inscription')->with(['message' => 'Le Numéro en cas d\'indisponibilité est déjà attribué à un participant.']);
        }
        $participants = count(Participant::where('sessionformations_id', $request->sessionformations_id)->get());
        $capacite = Sessionformation::select('capacite')->find($request->sessionformations_id)->capacite;


        if ($participants < $capacite) {
            $data = new Fondateur([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'contact' => $request->contact,
                'contact_2' => $request->contact_2,
                'fonctionpersonnels_id' => $request->fonctionpersonnels_id,
            ]);
            if ($data->save()) {
                // Création de Fondateur et Etablissement
                $data->etablissements()->sync($request->etablissements_id);
                // $rubric = new Fondateuretablissement([
                //     'etablissements_id' => $request->etablissements_id,
                //     'fondateurs_id' => $data->id
                // ]);
                $participants = new Participant([
                    'sessionformations_id' => $request->sessionformations_id,
                    'fondateurs_id' => $data->id
                ]);
                $participants->save();
            };

            //  Send mail to admin
            // \Mail::send('SendMail', $data, function ($message) use ($data) {
            //     $message->to($data['adress_post'], 'Demande de stage');
            //     $message->subject('Vos accès à la plateforme');
            //     $message->from('cpntic@formation.gouv.ci');
            // });
            return redirect('/inscription')->with(['message' => 'Votre inscription à la session de formation a été enregistrer avec succes!']);
        } else {
            return redirect('/inscription')->with(['message' => 'Nombre de place limite atteinte !']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
