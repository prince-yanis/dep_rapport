<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta name="generator" content="Aspose.Words for .NET 24.8.0" />
    <title></title>

    <style type="text/css">
        th {
            background-color: #0856ba;
            text-align: center;
            font-size: 14px;
            color: #fff;
        }

        .page {
            page-break-after: always;
        }

        .sommaire {
            font-size: 14px;
            line-height: 1.5;
        }

        .section-title {
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div>
        <div style="width: 100%; text-align: center;">
            <img src="https://formation-professionnelle.gouv.ci/wp-content/uploads/2023/06/LOGO-SITE-02-1.png"
                height="170">
        </div>
        <br><br>
        <div style="width: 35%; text-align: center;">
            <p style="margin-top: -40px;">----------------------</p>
            <p style="font-weight: bold; margin-bottom: -20px;">DIRECTION GENERALE
                DE LA FORMATION INITIALE
            <p>
            <p style="margin-top: -10px;">----------------------</p>
            <p style="font-weight: bold; margin-top: -20px;">DIRECTION DE L'ENCADREMENT
                DES ETABLISSEMENTS PRIVES
            </p>
            <p style="margin-top: -20px;">----------------------</p>
        </div>
        <br><br>

        <div class="page">
            <h3
                style="padding:10px 30px; margin: 5px 200px; border: 2px solid black; font-weight: bold; text-align: center;">
                RAPPORT DU PREMIER SEMESTRE DES ETABLISSEMENTS SCOLAIRES PRIVES </h3>

            <h3 style="font-weight: bold; text-align: center; margin-top: 50px; text-decoration: underline;">
                SOMMAIRE
            </h3>
            <br>

            <div class="sommaire">
                <p><strong>INTRODUCTION</strong></p>
                
                <p><strong>1. PERSONNEL ENSEIGNANT</strong></p>
                <p style="margin-left: 20px;">1.1. Effectif du personnel enseignant</p>
                <p style="margin-left: 20px;">1.2. Conseils d'enseignement</p>
                <p style="margin-left: 20px;">1.3. Besoins en personnel enseignant</p>
                
                <p><strong>2. APPRENANTS</strong></p>
                <p style="margin-left: 20px;">2.1. Effectif des Apprenants par niveau et par classe</p>
                <p style="margin-left: 20px;">2.1.1. Enseignement technique</p>
                <p style="margin-left: 20px;">2.1.2. Formation professionnelle</p>
                <p style="margin-left: 20px;">2.1.3. Enseignement supérieur</p>
                <p style="margin-left: 20px;">2.2. Effectifs des Apprenants de 1ère année et de seconde en fonction du mode de recrutement</p>
                <p style="margin-left: 20px;">2.3. Statut des Apprenants par filière et par niveau</p>
                <p style="margin-left: 20px;">2.4. Récapitulatif général</p>
                <p style="margin-left: 20px;">2.5. cours du soir</p>
                
                <p><strong>3. POINT DE L'EXECUTION DES PROGRAMMES ET PROGRESSIONS</strong></p>
                <p style="margin-left: 20px;">3.1. Niveau d'exécution des programmes et progressions</p>
                <p style="margin-left: 20px;">3.2. Difficultés dans l'exécution des programmes et progressions</p>
                
                <p><strong>4. RESULTATS DU PREMIER SEMETRE</strong></p>
                <p style="margin-left: 20px;">4.1. Résultats par classe et par niveau</p>
                <p style="margin-left: 20px;">4.2. Tableau récapitulatif des résultats par niveau et par filière</p>
                <p style="margin-left: 20px;">4.3. Cas d'abandon et ou de report de scolarité avec les motifs</p>
                
                <p><strong>5. INFRASTRUCTURES ET LOCAUX</strong></p>
                <p style="margin-left: 20px;">5.1. Bâtiments</p>
                <p style="margin-left: 20px;">5.2. Clôture</p>
                <p style="margin-left: 20px;">5.3. Problèmes liés aux infrastructures</p>
                
                <p><strong>6. INVENTAIRE GENERAL DU MATERIEL ET DES EQUIPEMENTS</strong></p>
                <p style="margin-left: 20px;">6.1. Matériels</p>
                <p style="margin-left: 20px;">6.2. Équipements</p>
                
                <p><strong>7. PROBLEMES URGENTS</strong></p>
                
                <p><strong>CONCLUSION</strong></p>
            </div>
        </div>

        <div class="page">
            <h3 class="section-title">INTRODUCTION</h3>
            
            <p style="margin-top: 7.1pt;font-family: Helvetica; font-weight: bold">I-1. Dénomination de
                l'établissement
                (en
                entier et en lettres capitales) </p>
            <p style="margin-top: 8.65pt">
                <span style="font-family: Helvetica; letter-spacing: -0.1pt">
                    <b>{{ $etablissements->denominationetab ?? 'Non renseigné' }}</b> &nbsp; &nbsp; &nbsp; Sigle:
                </span>
            </p>

            <p style="margin-top: 7.1pt;font-family: Helvetica; font-weight: bold">I-2. Contacts de l'établissement
            </p>
            <br>

            <p class="ListParagraph" style="margin-top: 1.8pt; font-family: Helvetica">
                <span style="font-family: Helvetica">Téléphone de l'établissement Cel :
                    <b>{{ $etablissements->contact ?? 'Non renseigné' }}</b></span>&nbsp;&nbsp;&nbsp;&nbsp;
                <span style="font-family: Helvetica">Fixe : </span>
            </p>

            <p class="ListParagraph" style="margin-top: 4pt; font-family: Helvetica">
                <span style="font-family: Helvetica">Nom et Prénoms du Fondateur:
                    <b>{{ $etablissements->nomfondateur ?? 'Non renseigné' }}</b>
            </p>

            <p style="margin-top: 8.65pt;font-family: Helvetica; letter-spacing: -0.1pt;">
                I-3. Ordre d'enseignement de l'établissement:
                <span style="font-family: Helvetica; letter-spacing: -0.1pt; font-weight: normal !important;">
                    <b>{{ $etablissements->libelleenseignement }}</b></span>
            </p>

            <p style="margin-top: 8.65pt; font-family: Helvetica;">
                I-4. Code de L'établissement :
                <span style="font-family: Helvetica; letter-spacing: -0.1pt">
                    <b>{{ $etablissements->code }}</b></span>
                &nbsp;
            </p>

            <p style="margin-top: 5.25pt">
                <span style="font-family: Helvetica; font-weight: bold">I-6. Localisation</span>
            </p>
            <p style="margin-top: 8pt">
                <span style="font-family: Helvetica">I-6-1. Direction régionale :
                    <b>{{ $etablissements->denominationdr ?? 'Non renseigné' }} </b></span>
            </p>
            <p style="margin-top: 10pt">
                <span style="font-family: Helvetica">Départementale
                    : <b>{{ $etablissements->denominationdd ?? 'Non renseigné' }}</b> </span>
            </p>

            <p style="margin-top: 6.75pt">
                <span style="font-family: Helvetica; letter-spacing: -0.1pt">I-6-2. Commune:
                    <b>{{ $etablissements->denominationcommune ?? 'Non renseigné' }}</b>. &nbsp; &nbsp;&nbsp; &nbsp;
                    Ville: <b>{{ $etablissements->denominationdepartement ?? 'Non renseigné' }}</b></span>
            </p>
            <p style="margin-top: 6.75pt">
                <span style="font-family: Helvetica; letter-spacing: -0.1pt">I-6-3. Quartier :
                    <b> {{ $etablissements->localisation ?? 'Non renseigné' }} </b></span>
            </p>
        </div>

        <div class="page">
            <h3 class="section-title">1. PERSONNEL ENSEIGNANT</h3>
            
            <h4 style="font-weight: bold; margin-top: 20px;">1.1. Effectif du personnel enseignant</h4>
            
            @if ($nbre_personnels > 0)
                <table border="1" cellpadding="3" cellspacing="0"
                    style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                    <thead>
                        <tr>
                            <th style="width: 5%">N°</th>
                            <th>Nom & Prénoms</th>
                            <th>Matricule</th>
                            <th>Sexe</th>
                            <th>Type de personnel</th>
                            <th>Date de naissance</th>
                            <th>Lieu de naissance</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Diplome</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personnels as $personnel)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $personnel->nom . ' ' . $personnel->prenoms ?? '' }}</td>
                                <td>{{ $personnel->matricule ?? '' }}</td>
                                <td>{{ $personnel->sexe ?? '' }}</td>
                                <td>{{ $personnel->libelletypepersonnel ?? '' }}</td>
                                <td>{{ $personnel->datenaissance ?? '' }}</td>
                                <td>{{ $personnel->lieunaissance ?? '' }}</td>
                                <td>{{ $personnel->pemail ?? '' }}</td>
                                <td>{{ $personnel->tel ?? '' }}</td>
                                <td>{{ $personnel->libellediplome ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucune donnée existante.
                </p>
            @endif

            <h4 style="font-weight: bold; margin-top: 30px;">1.2. Conseils d'enseignement</h4>
            
            @if ($conseilsEnseignement->count() > 0)
                <table border="1" cellpadding="3" cellspacing="0"
                    style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                    <thead>
                        <tr>
                            <th style="width: 5%">N°</th>
                            <th>Nom & Prénoms</th>
                            <th>Discipline</th>
                            <th>Contact</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($conseilsEnseignement as $conseil)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $conseil['nom'] . ' ' . $conseil['prenoms'] }}</td>
                                <td>{{ $conseil['discipline'] }}</td>
                                <td>{{ $conseil['telephone'] }}</td>
                                <td>{{ $conseil['email'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucun conseil d'enseignement enregistré.
                </p>
            @endif

            <h4 style="font-weight: bold; margin-top: 30px;">1.3. Besoins en personnel enseignant</h4>
            
            @if ($besoinpersonnelens->count() > 0)
                <table border="1" cellpadding="3" cellspacing="0"
                    style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                    <thead>
                        <tr>
                            <th style="width: 5%">N°</th>
                            <th>Discipline</th>
                            <th>Niveau</th>
                            <th>Nombre requis</th>
                            <th>Observations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($besoinpersonnelens as $besoin)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $besoin->libellediscipline ?? '' }}</td>
                                <td>{{ $besoin->libelleniveauenseignant ?? '' }}</td>
                                <td>{{ $besoin->nomberequis ?? '' }}</td>
                                <td>{{ $besoin->observation ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucun besoin en personnel enregistré.
                </p>
            @endif
        </div>

        <div class="page">
            <h3 class="section-title">2. APPRENANTS</h3>
            
            <h4 style="font-weight: bold; margin-top: 20px;">2.1. Effectif des Apprenants par niveau et par classe</h4>
            
            @if ($nbre_classes > 0)
                <table border="1" cellpadding="5" cellspacing="0"
                    style="width: 100%; table-layout: fixed; font-size: 13px !important;">
                    <thead>
                        <tr>
                            <th style="width: 5%">N°</th>
                            <th>Dénomination</th>
                            <th style="width: 15%">Effectif total</th>
                            <th style="width: 7%">Garçons</th>
                            <th style="width: 7%">Filles</th>
                            <th style="width: 7%">Boursiers</th>
                            <th style="width: 7%">Non boursiers</th>
                            <th style="width: 7%">Affectés</th>
                            <th style="width: 7%">Non affectés</th>
                            <th>Groupe pédagogique</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classes as $classe)
                            <tr style="text-align: center">
                                <td style="height: 35px;">{{ $loop->iteration }}</td>
                                <td>{{ $classe->denominationclasse ?? '' }}</td>
                                <td>{{ $classe->effectif_total ?? '' }}</td>
                                <td>{{ $classe->effectif_gar ?? '' }}</td>
                                <td>{{ $classe->effectif_fil ?? '' }}</td>
                                <td>{{ $classe->effectif_boursier ?? '' }}</td>
                                <td>{{ $classe->effectif_nonboursier ?? '' }}</td>
                                <td>{{ $classe->effectif_affecte ?? '' }}</td>
                                <td>{{ $classe->effectif_nonaffecte ?? '' }}</td>
                                <td>{{ $classe->libellegp ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucune classe existante.
                </p>
            @endif

            <h4 style="font-weight: bold; margin-top: 30px;">2.2. Effectifs des Apprenants de 1ère année et de seconde en fonction du mode de recrutement</h4>
            
            @if ($effectifsrecrutements->count() > 0)
                <table border="1" cellpadding="5" cellspacing="0"
                    style="width: 100%; table-layout: fixed; font-size: 13px !important;">
                    <thead>
                        <tr>
                            <th style="width: 5%">N°</th>
                            <th>Diplôme</th>
                            <th>Filière</th>
                            <th>Mode de recrutement</th>
                            <th>Effectif</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($effectifsrecrutements as $recrutement)
                            <tr style="text-align: center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $recrutement->libellediplome ?? '' }}</td>
                                <td>{{ $recrutement->libellefiliere ?? '' }}</td>
                                <td>{{ $recrutement->moderecrutement ?? '' }}</td>
                                <td>{{ $recrutement->effectif ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucune donnée de recrutement existante.
                </p>
            @endif

            <h4 style="font-weight: bold; margin-top: 30px;">2.3. Statut des Apprenants par filière et par niveau</h4>
            
            @if ($statutsapprenants->count() > 0)
                <table border="1" cellpadding="5" cellspacing="0"
                    style="width: 100%; table-layout: fixed; font-size: 13px !important;">
                    <thead>
                        <tr>
                            <th style="width: 5%">N°</th>
                            <th>Diplôme</th>
                            <th>Filière</th>
                            <th>Niveau</th>
                            <th>Affectés</th>
                            <th>Non affectés</th>
                            <th>Boursiers</th>
                            <th>Non boursiers</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statutsapprenants as $statut)
                            <tr style="text-align: center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $statut->libellediplome ?? '' }}</td>
                                <td>{{ $statut->libellefiliere ?? '' }}</td>
                                <td>{{ $statut->libelleniveau ?? '' }}</td>
                                <td>{{ $statut->nbreaffecte ?? '' }}</td>
                                <td>{{ $statut->nbrenonaffecte ?? '' }}</td>
                                <td>{{ $statut->nbreboursier ?? '' }}</td>
                                <td>{{ $statut->nbrenonboursier ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucune donnée de statut existante.
                </p>
            @endif

            <h4 style="font-weight: bold; margin-top: 30px;">2.4. Récapitulatif général</h4>
            
            @if ($recapGens->count() > 0)
                <table border="1" cellpadding="5" cellspacing="0"
                    style="width: 100%; table-layout: fixed; font-size: 13px !important;">
                    <thead>
                        <tr>
                            <th style="width: 5%">N°</th>
                            <th>Niveau</th>
                            <th>Effectif total</th>
                            <th>Garçons</th>
                            <th>Filles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recapGens as $recap)
                            <tr style="text-align: center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $recap->libelleniveau ?? '' }}</td>
                                <td>{{ $recap->effectif_total ?? '' }}</td>
                                <td>{{ $recap->effectif_gar ?? '' }}</td>
                                <td>{{ $recap->effectif_fil ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucune donnée récapitulative existante.
                </p>
            @endif

            <h4 style="font-weight: bold; margin-top: 30px;">2.5. Cours du soir</h4>
            <p style="color: #ed7d31; font-style: italic; text-align: center">
                [Section à développer selon les données disponibles]
            </p>
        </div>

        <div class="page">
            <h3 class="section-title">3. POINT DE L'EXECUTION DES PROGRAMMES ET PROGRESSIONS</h3>
            
            <h4 style="font-weight: bold; margin-top: 20px;">3.1. Niveau d'exécution des programmes et progressions</h4>
            
            @if ($pointexecutions->count() > 0)
                <table border="1" cellpadding="5" cellspacing="0"
                    style="width: 100%; table-layout: fixed; font-size: 13px !important;">
                    <thead>
                        <tr>
                            <th style="width: 5%">N°</th>
                            <th>Discipline</th>
                            <th>Niveau d'exécution</th>
                            <th>Progression</th>
                            <th>Observations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pointexecutions as $execution)
                            <tr style="text-align: center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $execution->libellediscipline ?? '' }}</td>
                                <td>{{ $execution->niveauexecution ?? '' }}</td>
                                <td>{{ $execution->progression ?? '' }}</td>
                                <td>{{ $execution->observation ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucune donnée d'exécution de programme existante.
                </p>
            @endif

            <h4 style="font-weight: bold; margin-top: 30px;">3.2. Difficultés dans l'exécution des programmes et progressions</h4>
            <p style="color: #ed7d31; font-style: italic; text-align: center">
                [Section à développer selon les données disponibles dans les observations]
            </p>
        </div>

        <div class="page">
            <h3 class="section-title">4. RESULTATS DU PREMIER SEMESTRE</h3>
            
            <h4 style="font-weight: bold; margin-top: 20px;">4.1. Résultats par classe et par niveau</h4>
            <p style="color: #ed7d31; font-style: italic; text-align: center">
                [Section à développer - Tableau des résultats du 1er semestre]
            </p>

            <h4 style="font-weight: bold; margin-top: 30px;">4.2. Tableau récapitulatif des résultats par niveau et par filière</h4>
            <p style="color: #ed7d31; font-style: italic; text-align: center">
                [Section à développer - Récapitulatif des résultats]
            </p>

            <h4 style="font-weight: bold; margin-top: 30px;">4.3. Cas d'abandon et ou de report de scolarité avec les motifs</h4>
            <p style="color: #ed7d31; font-style: italic; text-align: center">
                [Section à développer - Tableau des abandons et reports]
            </p>
        </div>

        <div class="page">
            <h3 class="section-title">5. INFRASTRUCTURES ET LOCAUX</h3>
            
            <h4 style="font-weight: bold; margin-top: 20px;">5.1. Bâtiments</h4>
            
            @if ($nbre_infrastructures > 0)
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed; font-size: 14px !important; text-align: center">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Libellé</th>
                            <th>Nombre</th>
                            <th>Capacité</th>
                            <th>Nombre de bureau</th>
                            <th>Fonctionnels</th>
                            <th>Non fonctionnels</th>
                            <th>Observation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($infrastructures as $infrastructure)
                            <tr>
                                <td style="height: 35px;">{{ $loop->iteration }}</td>
                                <td>{{ $infrastructure->libelleinfrastructure ?? 'Non renseigné' }}</td>
                                <td>{{ $infrastructure->nombre ?? 'Non renseigné' }}</td>
                                <td>{{ $infrastructure->cap ?? 'Non renseigné' }}</td>
                                <td>{{ $infrastructure->nombrebureaux ?? 'Non renseigné' }}</td>
                                <td>{{ $infrastructure->nbrefonctionnel ?? 'Non renseigné' }}</td>
                                <td>{{ $infrastructure->nbrenonfonctionel ?? 'Non renseigné' }}</td>
                                <td>{{ $infrastructure->obs ?? 'Non renseigné' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucune infrastructure existante.
                </p>
            @endif

            <h4 style="font-weight: bold; margin-top: 30px;">5.2. Clôture</h4>
            <p style="color: #ed7d31; font-style: italic; text-align: center">
                [Section à développer - État de la clôture]
            </p>

            <h4 style="font-weight: bold; margin-top: 30px;">5.3. Problèmes liés aux infrastructures</h4>
            
            @if ($nbre_probleme > 0)
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed; font-size: 14px !important; text-align: center">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Problème</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($probleme_urgents as $probleme)
                            <tr>
                                <td style="height: 35px;">{{ $loop->iteration }}</td>
                                <td>{{ $probleme->libelleprobleme ?? 'Non renseigné' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucun problème urgent signalé.
                </p>
            @endif
        </div>

        <div class="page">
            <h3 class="section-title">6. INVENTAIRE GENERAL DU MATERIEL ET DES EQUIPEMENTS</h3>
            
            <h4 style="font-weight: bold; margin-top: 20px;">6.1. Matériels</h4>
            
            @if ($nbre_equipements > 0)
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed;font-size: 14px !important; text-align: center;">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Matériel</th>
                            <th>Nombre</th>
                            <th>Fonctionnels</th>
                            <th>Non fonctionnels</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipements as $equipement)
                            <tr>
                                <td style="height: 35px;">{{ $loop->iteration }}</td>
                                <td>{{ $equipement->libellemateriel ?? 'Non renseigné' }}</td>
                                <td>{{ $equipement->nombre ?? 'Non renseigné' }}</td>
                                <td>{{ $equipement->nbrefonctionnel ?? 'Non renseigné' }}</td>
                                <td>{{ $equipement->nbrenonfonctionel ?? 'Non renseigné' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucun équipement existant.
                </p>
            @endif

            <h4 style="font-weight: bold; margin-top: 30px;">6.2. Équipements</h4>
            <p style="color: #ed7d31; font-style: italic; text-align: center">
                [Section à développer - Autres équipements spécifiques]
            </p>
        </div>

        <div class="page">
            <h3 class="section-title">7. PROBLEMES URGENTS</h3>
            
            @if ($nbre_probleme > 0)
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed; font-size: 14px !important; text-align: center">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Problème urgent</th>
                            <th>Degré d'urgence</th>
                            <th>Solutions proposées</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($probleme_urgents as $probleme)
                            <tr>
                                <td style="height: 35px;">{{ $loop->iteration }}</td>
                                <td>{{ $probleme->libelleprobleme ?? 'Non renseigné' }}</td>
                                <td>{{ $probleme->degreurgence ?? 'Non spécifié' }}</td>
                                <td>{{ $probleme->solution ?? 'Non spécifiée' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucun problème urgent signalé.
                </p>
            @endif
        </div>

        <div class="page">
            <h3 class="section-title">CONCLUSION</h3>
            
            @if ($nbre_conclusions > 0)
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed;font-size: 14px !important; text-align: center;">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Contenu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($conclusions as $conclusion)
                            <tr>
                                <td style="height: 35px;">{{ $loop->iteration }}</td>
                                <td>{{ $conclusion->libelleconclusion ?? 'Non renseigné' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucune conclusion enregistrée.
                </p>
            @endif
        </div>

    </div>
</body>

</html>
