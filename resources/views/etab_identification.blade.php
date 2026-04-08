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
            font-size: 12px !important;
            color: #fff;
        }

        td {
            word-wrap: break-word;
            /* Permet de couper les mots trop longs */
            overflow-wrap: break-word;
            /* Alternative pour certains navigateurs */
            white-space: normal;
            /* Permet le retour à la ligne si nécessaire */
        }

        .page {
            page-break-after: always;
        }

        .page-break {
            page-break-before: always;
            /* Saut de page avant */
            page-break-after: always;
            /* Saut de page après */
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        /* Styles améliorés pour les emplois du temps */
        .emploi-du-temps {
            width: 100%;
            table-layout: fixed;
            font-size: 11px !important;
            text-align: center;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .emploi-du-temps th {
            background-color: #2c3e50;
            color: white;
            padding: 8px;
            font-weight: bold;
            border: 1px solid #34495e;
        }

        .emploi-du-temps td {
            padding: 6px;
            border: 1px solid #bdc3c7;
            vertical-align: top;
            word-wrap: break-word;
            position: relative;
        }

        .emploi-du-temps .heure-col {
            background-color: #ecf0f1;
            font-weight: bold;
            width: 80px;
        }

        .emploi-du-temps .cours {
            background-color: #3498db;
            color: white;
            font-weight: 500;
        }

        .emploi-du-temps .vide {
            background-color: #f8f9fa;
            color: #6c757d;
            font-style: italic;
        }

        .emploi-du-temps .weekend {
            background-color: #f1f3f4;
        }

        .titre-emploi {
            background-color: #34495e;
            color: white;
            padding: 10px;
            margin: 20px 0 10px 0;
            border-radius: 5px;
            text-align: center;
        }

        .legende {
            margin: 10px 0;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
            font-size: 10px;
        }

        .legende-item {
            display: inline-block;
            margin: 5px 10px;
        }

        .legende-couleur {
            display: inline-block;
            width: 15px;
            height: 15px;
            margin-right: 5px;
            border: 1px solid #333;
        }

        @media print {
            .emploi-du-temps {
                page-break-inside: avoid;
            }

            .titre-emploi {
                page-break-after: avoid;
            }
        }
    </style>
</head>

<body>
    <div>
        <div style="width: 100%; text-align: center;">
            <img src="https://formation-professionnelle.gouv.ci/wp-content/uploads/2023/06/LOGO-SITE-02-1.png"
                height="170">
            <!-- <img src="{{ url('https://formation-professionnelle.gouv.ci/wp-content/uploads/2023/06/LOGO-SITE-02-1.png') }}" height="120"> -->
        </div>
        <br><br>
        <!-- <div style="width: 35%; text-align: center;">
            <p style="margin-top: -40px;">----------------------</p>
            <p style="font-weight: bold; margin-bottom: -20px;">DIRECTION GENERALE
                DE LA FORMATION INITIALE
            <p>
            <p style="margin-top: -10px;">----------------------</p>
            <p style="font-weight: bold; margin-top: -20px;">DIRECTION DE L’ENCADREMENT
                DES ETABLISSEMENTS PRIVES
            </p>
            <p style="margin-top: -20px;">----------------------</p>
        </div>
        <br><br>
        <br><br>

        <div class="page">
            <h3
                style="padding:10px 30px; margin: 5px 200px; border: 2px solid black; font-weight: bold; text-align: center;">
                RAPPORT DE LA RENTREE DES ETABLISSEMENTS SCOLAIRES PRIVES </h3>

            <h3 style="font-weight: bold; text-align: center; margin-top: 50px; text-decoration: underline;">
                I-IDENTIFICATION
            </h3>
            <br>

            <p style="margin-top: 7.1pt;font-family: Helvetica; font-weight: bold">I-1. Dénomination de l'établissement
                (en
                entier et en lettres capitales) </p>
            <p style="margin-top: 8.65pt">
                <span style="font-family: Helvetica; letter-spacing: -0.1pt">
                    <b>{{ $etablissements->denominationetab ?? 'Non renseigné' }}</b> &nbsp; &nbsp; &nbsp; Sigle:
                    {{ $etablissements->sigle ?? 'Non renseigné' }}
                </span>
            </p>

            <p style="margin-top: 7.1pt;font-family: Helvetica; font-weight: bold">I-2. Contacts de l'établissement </p>
            <br>

            <p class="ListParagraph" style="margin-top: 1.8pt; font-family: Helvetica">
                <span style="font-family: Helvetica">Téléphone de l'établissement :
                    <b>{{ $etablissements->contact ?? 'Non renseigné' }}</b></span>&nbsp;&nbsp;&nbsp;&nbsp;
            </p>

            <p class="ListParagraph" style="margin-top: 4pt; font-family: Helvetica">
                <span style="font-family: Helvetica">Nom et Prénoms du Fondateur:
                    <b>{{ $etablissements->nomfondateur ?? 'Non renseigné' }}</b>
            </p>

            <br>

            <p style="margin-top: 8.65pt;font-family: Helvetica; letter-spacing: -0.1pt;">
                I-3. Ordre d'enseignement de l'établissement:
                <span style="font-family: Helvetica; letter-spacing: -0.1pt; font-weight: normal !important;">
                    <b>{{ $etablissements->libelleenseignement }}</b></span>

            </p>

            <p style="margin-top: 8.65pt; font-family: Helvetica;">
                I-4. Code de L'établissement :
                <span style="font-family: Helvetica; letter-spacing: -0.1pt"> <b>{{ $etablissements->code }}</b></span>
                &nbsp;

            </p>
            <br>
            <p style="margin-top: 5.25pt">
                <span style="font-family: Helvetica; font-weight: bold">I-6. Localisation</span>
            </p>
            <p style="margin-top: 8pt">
                <span style="font-family: Helvetica">I-6-1. Direction régionale :
                    <b>{{ $etablissements->denominationdd ?? 'Non renseigné' }} </b></span>
            </p>

            <p style="margin-top: 6.75pt">
                <span style="font-family: Helvetica; letter-spacing: -0.1pt">I-6-1. Commune:
                    <b>{{ $etablissements->denominationcommune ?? 'Non renseigné' }}</b>. &nbsp; &nbsp;&nbsp; &nbsp;
            </p>
            <p style="margin-top: 6.75pt">
                <span style="font-family: Helvetica; letter-spacing: -0.1pt">I-6-2. Quartier :
                    <b> {{ $etablissements->localisation ?? 'Non renseigné' }} </b></span>
            </p>

            <p style="margin-top: 6.1pt">
                <span style="font-family: Helvetica; vertical-align: 0.5pt">1-6-3. GPS (Coordonnées) :
                    <b> {{ $etablissements->latitude ?? 'Pas' }} ,
                        {{ $etablissements->longitude ?? 'indiqué' }}</b></span>
            </p>

            <br>
            <p style="margin-top: 8.9pt">
                <span style="font-family: Helvetica;  font-weight: bold; vertical-align: 0.5pt; ">1-7 Numéros
                    d'identification</span>
            </p>
            <p style="margin-top: 8.9pt">
                <span style="font-family: Helvetica; vertical-align: 0.5pt">1-7-1 Numéro d'autorisation de création
                </span>
            </p>
            <p style="margin-top: 7.15pt">
                <span style="font-family: Helvetica; ">1-7-1-1. {{ $etablissements->libelleenseignement }} :
                    <b> {{ $etablissements->numautorisationcreation ?? 'Non renseigné' }} </b> </span>
            </p>
        </div> -->
        <div style="padding:10px 30px; margin: 5px 200px;  font-weight: bold; text-align: center;">

            <h2 style="font-weight: bold; font-size: 40px;">DIRECTION GENERALE
                DE LA FORMATION INITIALE
            </h2>
            <p style="margin-top: -25px;">----------------------</p>
            <h2 style="font-weight: bold; font-size: 40px; color: #174e84ff; margin-top: -10px;">DIRECTION
                DES ETABLISSEMENTS PUBLICS
            </h2>
        </div>
        <br>

        <div class="page">
            <h2 style="padding:10px 30px; margin: 5px 200px;  font-weight: bold; text-align: center;">ETABLISSEMENTS :
            </h2>
            <h1 style="padding:10px 30px; margin: 5px 200px;  font-weight: bold; text-align: center; font-size: 80px;">
                RAPPORT DE<br> RENTRÉE
            </h1>

            <h3 style="padding:10px 30px; margin: 5px 200px;  font-weight: bold; text-align: center; font-size: 30px;">
                ANNÉE DE FORMATION :
            </h3>
            <br><br>
            <br><br>

            <div style="page-break-after: always;">
                <h3
                    style="padding:10px 30px; margin: 5px 200px;  font-weight: bold; text-align: center; font-size: 30px;">
                    SOMMAIRE
                </h3>

                <p style="font-weight: bold">1. PRESENTATION DE L’ETABLISSEMENT ET DES FILIERES DE FORMATION</p>
                <p>1.1. Présentation de l’établissement</p>
                <p>1.2. Filières de formation</p>
                <p>1.3. Nombre de classe par filière</p><br>
                <p style="font-weight: bold">2. EQUIPE DE DIRECTION ET AUTRES PERSONNELS ADMINISTRATIFS</p>
                <p>2.1. Equipe de direction</p>
                <p>2.2. Autres personnels administratifs</p>
                <p>2.3. Besoins en personnels administratifs et autres</p><br>
                <p style="font-weight: bold">3. PERSONNEL ENSEIGNANT</p>
                <p>3.1. Effectif du personnel enseignant</p>
                <p>3.2. Conseils d’enseignement</p>
                <p>3.3. Besoins en personnel enseignant</p><br>
                <p style="font-weight: bold">4. APPRENANTS</p>
                <p>4.1. Effectif des Apprenants par niveau et par classe</p>
                <p>4.1.1. Enseignement technique</p>
                <p>4.1.2. Formation professionnelle</p>
                <p>4.1.3. Enseignement supérieur</p>
                <p>4.2. Effectifs des Apprenants de 1ère année et de seconde en fonction du mode de recrutement</p>
                <p>4.3. Statut des Apprenants par filière et par niveau</p>
                <p>4.4. Recapitulatif général</p>
                <p>4.5. cours du soir</p><br>
                <p style="font-weight: bold">5. POINT DE LEXECUTION DES PROGRAMMES ET PROGRESSIONS</p><br>
                <p style="font-weight: bold">6. INDICATEURS DE PERFORMANCE</p><br>
                <p style="font-weight: bold">7. INFRASTRUCTURES ET LOCAUX</p>
                <p>7.1. Bâtiments</p>
                <p>7.2. Clôture</p>
                <p>7.3. Problèmes liés aux infrastructures</p><br>

                <p style="font-weight: bold">8. INVENTAIRE GENERAL DU MATERIEL ET DES EQUIPEMENTS</p>
                <p>8.1. Matériels </p>
                <p>8.2. Équipements</p><br>
                <p style="font-weight: bold">9. GESTION FINANCIERE</p>
                <p>9.1. État du budget</p>
                <p>9.2. Ressources additionnelles</p><br>
                <p style="font-weight: bold">10. COMITE DE GESTION</p><br>

                <p style="font-weight: bold">11. ACTIVITES SOCIO-EDUCATIVES</p>
                <p>11.1. Activités sportives</p>
                <p>11.2. Clubs et associations</p><br>

                <p style="font-weight: bold">12. PROBLEMES URGENTS</p><br>

                <p style="font-weight: bold">13. PERSPECTIVES</p><br>

                <p style="font-weight: bold">CONCLUSION</p>

            </div>

            <div style="page-break-after: always; padding-top: 60px;">
                <h3
                    style="padding:10px 30px; margin: 5px 200px;  font-weight: bold; text-align: center; font-size: 20px;">
                    ANNEXE
                </h3>
                <ul style="list-style-type: disc;">
                    <li>Listes des personnels (administratif, enseignant et autres)</li>
                    <li>Listes des stagiaires et étudiants par classe</li>
                    <li>Emplois du temps classe</li>
                    <li>Emplois du temps professeurs</li>
                    <li>Liste des Enseignants ayant des heures supplémentaires</li>
                </ul>
            </div>


        </div>
        <div style="page-break-after: always; padding-top: 60px;">

            <p style="font-weight: bold">1. PRESENTATION DE L’ETABLISSEMENT ET DES FILIERES DE FORMATION</p>
            <h3>1.1. Présentation de l’établissement</h3>
            <ul style="list-style-type: disc;">
                <li>Direction Régionale : {{ $etablissements->denominationdd ?? 'Non renseigné' }} </li>
                <li>Établissement : {{ $etablissements->denominationetab ?? 'Non renseigné' }}</li>
                <li>Code : {{ $etablissements->code }}</li>
                <li>Date de créarion de l'établissement : </li>
                <li>Date d'ouverture de l'établissement : </li>
                <li>Situation géographique : </li>
                <li>Adresse postale :....................................................Téléphone
                    :   {{ $etablissements->contact ?? 'Non renseigné' }}       Mobile : </li>
                <li>Fax :.....................................Email : </li>

            </ul>

        </div>

        <div>
            <h3>Filières de formations</h3>
            @if ($nbre_filiere_enseignes > 0)
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                    <thead>
                        <tr>
                            <th style="width: 5%">N°</th>
                            <th>Filière / Série</th>
                            <th>Code</th>
                            <th>Diplômes préparés</th>
                            <th>Durée des études</th>
                            <th>Observations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filiere_enseignes as $filiere_enseigne)
                            <tr>
                                <td>{{ $loop->iteration ?? '' }}</td>
                                <td>{{ $filiere_enseigne->libellefiliere ?? '' }}</td>
                                <td>{{ $filiere_enseigne->filnumaut ?? '' }}</td>
                                <td>{{ $filiere_enseigne->dureeformation ?? '' }}</td>
                                <td>{{ $filiere_enseigne->libellediplome ?? '' }}</td>
                                <td>{{ $filiere_enseigne->observation ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed; text-align: center">
                    <thead>
                        <tr>
                            <th style="width: 5%">N°</th>
                            <th>Filière</th>
                            <th>N° autorisation d'ouverture</th>
                            <th>Durée de la formation</th>
                            <th>Diplôme préparé</th>
                            <th>Observation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" style="color: #ed7d31; font-weight: bold; font-style: italic">Aucune
                                donnée
                                existante.</td>
                        </tr>
                    </tbody>
                </table>
            @endif

            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Nombre de classes par filière</span>
            </p>
            @if ($etablissements->ordre_enseignement_id == 2)
                <table border="1" cellpadding="3" cellspacing="0"
                    style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                    <thead>
                        <tr>
                            <th>Diplômes</th>
                            <th>Filières</th>
                            <th>Première année</th>
                            <th>Deuxième année</th>
                            <th>Troisième année</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classefilieres as $classefiliere)
                            <tr>
                                <td>{{ $classefiliere->libellediplome ?? '' }}</td>
                                <td>{{ $classefiliere->libellefiliere ?? '' }}</td>
                                <td>{{ $classefiliere->premiere_annee ?? '' }}</td>
                                <td>{{ $classefiliere->deuxieme_annee ?? '' }}</td>
                                <td>{{ $classefiliere->troisieme_annee ?? '' }}</td>
                                <td>{{ $classefiliere->premiere_annee + $classefiliere->deuxieme_annee + $classefiliere->troisieme_annee ?? '' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            @if ($etablissements->ordre_enseignement_id == 1)
                <table border="1" cellpadding="3" cellspacing="0"
                    style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                    <thead>
                        <tr>
                            <th>Diplômes</th>
                            <th>Filières</th>
                            <th>Seconde</th>
                            <th>Premiere</th>
                            <th>Terminale</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classefilieres as $classefiliere)
                            <tr>
                                <td>{{ $classefiliere->libellediplome ?? '' }}</td>
                                <td>{{ $classefiliere->libellefiliere ?? '' }}</td>
                                <td>{{ $classefiliere->seconde ?? '' }}</td>
                                <td>{{ $classefiliere->premiere ?? '' }}</td>
                                <td>{{ $classefiliere->terminale ?? '' }}</td>
                                <td>{{ $classefiliere->seconde + $classefiliere->premiere + $classefiliere->terminale ?? '' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            @if ($etablissements->ordre_enseignement_id == 4)
                <p>Enseignement professionnel</p>
                <table border="1" cellpadding="3" cellspacing="0"
                    style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                    <thead>
                        <tr>
                            <th>Diplômes</th>
                            <th>Filières</th>
                            <th>Première année</th>
                            <th>Deuxième année</th>
                            <th>Troisième année</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classefilierepros as $classefilierepro)
                            <tr>
                                <td>{{ $classefilierepro->libellediplome ?? '' }}</td>
                                <td>{{ $classefilierepro->libellefiliere ?? '' }}</td>
                                <td>{{ $classefilierepro->premiere_annee ?? '' }}</td>
                                <td>{{ $classefilierepro->deuxieme_annee ?? '' }}</td>
                                <td>{{ $classefilierepro->troisieme_annee ?? '' }}</td>
                                <td>{{ $classefilierepro->premiere_annee + $classefilierepro->deuxieme_annee + $classefilierepro->troisieme_annee ?? '' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br><br>
                <p>Enseignement technique</p>
                <table border="1" cellpadding="3" cellspacing="0"
                    style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                    <thead>
                        <tr>
                            <th>Diplômes</th>
                            <th>Filières</th>
                            <th>Seconde</th>
                            <th>Premiere</th>
                            <th>Terminale</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classefilieretechs as $classefilieretech)
                            <tr>
                                <td>{{ $classefilieretech->libellediplome ?? '' }}</td>
                                <td>{{ $classefilieretech->libellefiliere ?? '' }}</td>
                                <td>{{ $classefilieretech->seconde ?? '' }}</td>
                                <td>{{ $classefilieretech->premiere ?? '' }}</td>
                                <td>{{ $classefilieretech->terminale ?? '' }}</td>
                                <td>{{ $classefilieretech->seconde + $classefilieretech->premiere + $classefilieretech->terminale ?? '' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Les personnels</span>
            </p>


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
                            <th>Fonction</th>
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
                                <td>{{ $personnel->libellefonction ?? '' }}</td>
                                <td>{{ $personnel->datenaissance ?? '' }}</td>
                                <td>{{ $personnel->lieunaissance ?? '' }}</td>
                                <td>{{ $personnel->pemail ?? '' }}</td>
                                <td>{{ $personnel->tel ?? '' }}</td>
                                <td>{{ $personnel->libellediplome ?? '' }}</td>
                                {{-- <td></td>
                <td></td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed; text-align: center">
                    <thead>
                        <tr>
                            <th style="width: 5%">N°</th>
                            <th>Nom & Prénoms</th>
                            <th>Matricule</th>
                            <th>Sexe</th>
                            <th>Type de personnel</th>
                            <th>Fonction</th>
                            <th>Date de naissance</th>
                            <th>Lieu de naissance</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Diplome</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="10"
                                style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                                Aucune
                                donnée
                                existante.</td>
                        </tr>
                    </tbody>
                </table>
            @endif


            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Les Conseils d'Enseignement (CE)</span>
            </p>

            <table border="1" cellpadding="3" cellspacing="0"
                style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Discipline</th>
                        <th>Nom et prénoms du RCE</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($personnels && $personnels->count() > 0)
                        @php
                            $conseilsEnseignement = $personnels->filter(function($personnel) {
                                return isset($personnel->cons_ens) && $personnel->cons_ens == 1;
                            });
                        @endphp
                        
                        @if ($conseilsEnseignement->count() > 0)
                            @foreach ($conseilsEnseignement as $index => $conseil)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $conseil->libellediscipline ?? 'aucune' }}</td>
                                    <td>{{ $conseil->nom . ' ' . $conseil->prenoms }}</td>
                                    <td>{{ $conseil->telephone ?? '' }}</td>
                                    <td>{{ $conseil->email ?? '' }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                                    Aucun Conseil d'Enseignement trouvé.
                                </td>
                            </tr>
                        @endif
                    @else
                        <tr>
                            <td colspan="5" style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                                Aucune donnée disponible.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <br><br>

            <p>
                <span style="font-family: Helvetica; font-weight: bold">Besoin en personnel enseignant</span>
            </p>


            <table border="1" cellpadding="8" cellspacing="0"
                style="width: 100%; table-layout: fixed; font-size: 14px !important; text-align: center">
                <thead>
                    <tr>
                        <th style="width: 3%;">N°</th>
                        <th>Niveau de l'enseignant</th>
                        <th>Discipline</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>


                    <tr>
                        <td style="height: 35px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                </tbody>
            </table>


            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Equipe de Direction</span>
            </p>

            <table border="1" cellpadding="3" cellspacing="0"
                style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                <thead>
                    <tr>
                        <th>Fonctions</th>
                        <th>Nom</th>
                        <th>Prénoms</th>
                        <th>Sexe</th>
                        <th>Discipline</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipedirections as $equipedirection)
                        <tr>
                            <td>{{ $equipedirection->libellefonction ?? '' }}</td>
                            <td>{{ $equipedirection->nom ?? '' }}</td>
                            <td>{{ $equipedirection->prenoms ?? '' }}</td>
                            <td>{{ $equipedirection->sexe ?? '' }}</td>
                            <td>{{ $equipedirection->libellediscipline ?? '' }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Autres personnels administratifs</span>
            </p>

            <table border="1" cellpadding="3" cellspacing="0"
                style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                <thead>
                    <tr>
                        <th rowspan="2">Fonctions</th>
                        <th colspan="2">Nombre</th> <!-- Fusionner les cellules pour "Nombre" -->
                        <th rowspan="2">TOTAL</th>
                        <th rowspan="2">Observations</th>
                    </tr>
                    <tr>
                        <th>Hommes</th> <!-- Sous-ligne pour "Hommes" -->
                        <th>Femmes</th> <!-- Sous-ligne pour "Femmes" -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($autrespersonnelsadmins as $autrespersonnelsadmin)
                        <tr>
                            <td>{{ $autrespersonnelsadmin->libellefonction ?? '' }}</td>
                            <td>{{ $autrespersonnelsadmin->HOMMES ?? '' }}</td>
                            <td>{{ $autrespersonnelsadmin->FEMMES ?? '' }}</td>
                            <td>{{ $autrespersonnelsadmin->FEMMES + $autrespersonnelsadmin->HOMMES ?? '' }}</td>
                            <td></td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Effectif du personnel enseignant par
                    discipline</span>
            </p>

            <table border="1" cellpadding="3" cellspacing="0"
                style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Discipline</th>
                        <th>HOMMES</th> <!-- Fusionner les cellules pour "Nombre" -->
                        <th>FEMMES</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($effectifsenseignants as $effectifsenseignant)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $effectifsenseignant->libellediscipline ?? '' }}</td>
                            <td>{{ $effectifsenseignant->HOMMES ?? '' }}</td>
                            <td>{{ $effectifsenseignant->FEMMES ?? '' }}</td>
                            <td>{{ $effectifsenseignant->FEMMES + $effectifsenseignant->HOMMES ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Effectif des apprenants par niveau et par
                    classe</span>
            </p>
            @foreach ($effectifsapprenantsParFilieres as $entete => $effectifsapprenants)
                <h2>{{ $entete }}</h2>
                <table border="1" cellpadding="3" cellspacing="0"
                    style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                    <thead>
                        <tr>
                            <th>Niveau</th>
                            <th>Filiere</th>
                            <th>Classe</th>
                            <th>Boursiers</th> <!-- Fusionner les cellules pour "Nombre" -->
                            <th>Non boursier</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($effectifsapprenants as $effectifsapprenant)
                            <tr>
                                <td>{{ $effectifsapprenant->libelleniveau ?? '' }}</td>
                                <td>{{ $effectifsapprenant->libellefiliere ?? '' }}</td>
                                <td>{{ $effectifsapprenant->denominationclasse ?? '' }}</td>
                                <td>{{ $effectifsapprenant->boursier ?? '' }}</td>
                                <td>{{ $effectifsapprenant->non_boursier ?? '' }}</td>
                                <td>{{ $effectifsapprenant->boursier + $effectifsapprenant->non_boursier ?? '' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach

            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Effectif des apprenants de 1ère année et de
                    seconde en fonction du mode de recrutement</span>
            </p>

            <table border="1" cellpadding="3" cellspacing="0"
                style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                <thead>
                    <tr>
                        <th>Diplome</th>
                        <th>Affectés</th>
                        <th>Non affectés</th> <!-- Fusionner les cellules pour "Nombre" -->
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($effectifsrecrutements as $effectifsrecrutement)
                        <tr>
                            <td>{{ $effectifsrecrutement->libellediplome ?? '' }}</td>
                            <td>{{ $effectifsrecrutement->affecte ?? '' }}</td>
                            <td>{{ $effectifsrecrutement->non_affecte ?? '' }}</td>
                            <td>{{ $effectifsrecrutement->affecte + $effectifsrecrutement->non_affecte ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Statut des apprenants par filière et par
                    niveau</span>
            </p>

            <table border="1" cellpadding="3" cellspacing="0"
                style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                <thead>
                    <tr>
                        <th>Filière</th>
                        <th>Diplôme</th>
                        <th>Niveau</th> <!-- Fusionner les cellules pour "Nombre" -->
                        <th>F</th>
                        <th>G</th>
                        <th>T</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($statutsapprenants as $statutsapprenant)
                        <tr>
                            <td>{{ $statutsapprenant->libellefiliere ?? '' }}</td>
                            <td>{{ $statutsapprenant->libellediplome ?? '' }}</td>
                            <td>{{ $statutsapprenant->libelleniveau ?? '' }}</td>
                            <td>{{ $statutsapprenant->F ?? '' }}</td>
                            <td>{{ $statutsapprenant->M ?? '' }}</td>
                            <td>{{ $statutsapprenant->F + $statutsapprenant->M ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Récapitulatif Général</span>
            </p>

            <table border="1" cellpadding="3" cellspacing="0"
                style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                <thead>
                    <tr>
                        <th>Niveau</th>
                        <th>CAP</th>
                        <th>SECONDAIRE PROFESSIONNEL</th> <!-- Fusionner les cellules pour "Nombre" -->
                        <th>SECONDAIRE TECHNIQUE</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recapGens as $recapGen)
                        <tr>
                            <td>{{ $recapGen->libelleniveau ?? '' }}</td>
                            <td>{{ $recapGen->CAP ?? '' }}</td>
                            <td>{{ $recapGen->BEP + $recapGen->BT ?? '' }}</td>
                            <td>{{ $recapGen->BAC ?? '' }}</td>
                            <td>{{ $recapGen->CAP + $recapGen->BEP + $recapGen->BT + $recapGen->BAC ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br> <br>

            <table border="1" cellpadding="3" cellspacing="0"
                style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                <thead>
                    <tr>
                        <th>Diplome</th>
                        <th>Niveau</th>
                        <th>Capacité d'accueil</th> <!-- Fusionner les cellules pour "Nombre" -->
                        <th>Effectif inscrits</th>
                        <th>Ecart</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recapEffectifs as $recapEffectif)
                        <tr>
                            <td>{{ $recapEffectif->libellediplome . '' . $recapEffectif->libellefiliere ?? '' }}</td>
                            <td>{{ $recapEffectif->libelleniveau ?? '' }}</td>
                            <td>{{ $recapEffectif->capaciteacceuil ?? '' }}</td>
                            <td>{{ $recapEffectif->EFFECTIFS ?? '' }}</td>
                            <td>{{ $recapEffectif->capaciteacceuil - $recapEffectif->EFFECTIFS ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br><br>

             <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Cours du soir</span>
            </p>

            <table border="1" cellpadding="3" cellspacing="0"
                style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                <thead>
                    <tr>
                        <th rowspan="2">Filière</th>
                        <th rowspan="2">Diplôme</th>
                        <th rowspan="2">Niveau</th> <!-- Fusionner les cellules pour "Nombre" -->
                        <th colspan="3">Effectif</th>
                        <th rowspan="2">Total général</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>F</td>
                        <td>G</td>
                        <td>T</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td rowspan="2">BTS</td>
                        <td>1ere année</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td rowspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>2eme année</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td rowspan="3">BAC</td>
                        <td>Seconde</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td rowspan="3"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Première</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Terminale</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td rowspan="3">BT</td>
                        <td>1A</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td rowspan="3"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>2A</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>3A</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td rowspan="3">CAP</td>
                        <td>1A</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td rowspan="3"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>2A</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>3A</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3">TOTAL</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                </tbody>
            </table>

            <br><br>


            <p>
                <span style="font-family: Helvetica; font-weight: bold">Point de l'exécution des programmes et
                    progressions</span>
            </p>

            <table border="1" cellpadding="3" cellspacing="0"
                style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Discipline</th>
                        <th>Nbre total de chapitres</th>
                        <th>Nbre de chapitres exécutés</th>
                        <th>% Chapitres exécutés</th>
                        <th>Nbre total de leçons</th>
                        <th>Nbre de leçons exécutées</th>
                        <th>% Leçons exécutées</th>
                        <th>Observations</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($pointexecutions && $pointexecutions->count() > 0)
                        @foreach ($pointexecutions as $pointexecution)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pointexecution->libellediscipline ?? '' }}</td>
                                <td>{{ $pointexecution->total_chapitre ?? '' }}</td>
                                <td>{{ $pointexecution->chapitres_execute ?? '' }}</td>
                                <td>{{ $pointexecution->pourcentage_chapitre ? number_format($pointexecution->pourcentage_chapitre, 2) . '%' : '' }}</td>
                                <td>{{ $pointexecution->total_lecon ?? '' }}</td>
                                <td>{{ $pointexecution->lecons_execute ?? '' }}</td>
                                <td>{{ $pointexecution->pourcentage_lecon ? number_format($pointexecution->pourcentage_lecon, 2) . '%' : '' }}</td>
                                <td>{{ $pointexecution->observations ?? '' }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">Aucune donnée existante.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <br><br>


            <p>
                <span style="font-family: Helvetica; font-weight: bold">Indicateurs de performances</span>
            </p>

            <table border="1" cellpadding="3" cellspacing="0"
                style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Indicateurs-clés de performance</th>
                        <th>Taux obtenu en 2024-2025</th>
                        <th>La cible en 2025-2026</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($indicateurs && $indicateurs->count() > 0)
                        @foreach ($indicateurs as $indicateur)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $indicateur->libelleitems ?? '' }}</td>
                                <td>{{ $indicateur->tauxobtenu_n1 ?? '' }}</td>
                                <td>{{ $indicateur->tauxcible ?? '' }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">Aucune donnée existante.</td>
                        </tr>
                    @endif
                </tbody>
            </table>


            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Etat d'exécution du budget</span>
            </p>

            <table border="1" cellpadding="3" cellspacing="0"
                style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Ligne budgétaire</th>
                        <th>Désignation</th>
                        <th>Montant </th>
                        <th>Engagement réalisé</th>
                        <th>Solde</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($executionbudgets && $executionbudgets->count() > 0)
                        @php
                            $totalDotation = 0;
                            $totalEngagement = 0;
                            $totalSolde = 0;
                        @endphp
                        @foreach ($executionbudgets as $executionbudget)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $executionbudget->ligne_budgetaire ?? '' }}</td>
                                <td>{{ $executionbudget->designation ?? '' }}</td>
                                <td>{{ number_format($executionbudget->dotation ?? 0, 0, ',', ' ') }}</td>
                                <td>{{ number_format($executionbudget->engagement ?? 0, 0, ',', ' ') }}</td>
                                <td>{{ number_format($executionbudget->solde ?? 0, 0, ',', ' ') }}</td>
                            </tr>
                            @php 
                                $totalDotation += $executionbudget->dotation ?? 0; 
                                $totalEngagement += $executionbudget->engagement ?? 0; 
                                $totalSolde += $executionbudget->solde ?? 0; 
                            @endphp
                        @endforeach
                        <tr>
                            <td colspan="3">TOTAL DOTATION BUDGETAIRE</td>
                            <td>{{ number_format($totalDotation, 0, ',', ' ') }}</td>
                            <td>{{ number_format($totalEngagement, 0, ',', ' ') }}</td>
                            <td>{{ number_format($totalSolde, 0, ',', ' ') }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="6" style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">Aucune donnée existante.</td>
                        </tr>
                    @endif
                </tbody>
            </table>


            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Ressources additionnelles</span>
            </p>

            @if ($ressourcesadditionnelles && $ressourcesadditionnelles->count() > 0)
                @foreach ($ressourcesadditionnelles as $ressource)
                    <p style="margin-bottom: 5px;">
                        <strong>Banque :</strong> {{ $ressource->banque ?? '' }}<br>
                        <strong>Numéro de compte :</strong> {{ $ressource->numero_compte ?? '' }}
                    </p>
                @endforeach
            @else
                <p style="color: #ed7d31; font-weight: bold; font-style: italic;">Aucune ressource additionnelle enregistrée.</p>
            @endif

            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Frais d’inscription et de scolarité (cours du
                    soir)</span>
            </p>

            <table border="1" cellpadding="3" cellspacing="0"
                style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nature</th>
                        <th>Nombre d'élèves</th>
                        <th>Total perçus </th>
                        <th>Part établissement</th>
                        <th>Part fonds école</th>
                        <th>Observations</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($fraisscolarites && $fraisscolarites->count() > 0)
                        @php 
                            $totalEleves = 0; 
                            $totalPerçu = 0; 
                            $totalEtab = 0; 
                            $totalFonds = 0; 
                        @endphp
                        @foreach ($fraisscolarites as $fraisscolarite)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $fraisscolarite->nature ?? '' }}</td>
                                <td>{{ $fraisscolarite->nombre_eleve ?? '' }}</td>
                                <td>{{ number_format($fraisscolarite->total_percus ?? 0, 0, ',', ' ') }}</td>
                                <td>{{ number_format($fraisscolarite->part_etab ?? 0, 0, ',', ' ') }}</td>
                                <td>{{ number_format($fraisscolarite->part_fonds ?? 0, 0, ',', ' ') }}</td>
                                <td>{{ $fraisscolarite->observations ?? '' }}</td>
                            </tr>
                            @php 
                                $totalEleves += $fraisscolarite->nombre_eleve ?? 0; 
                                $totalPerçu += $fraisscolarite->total_percus ?? 0; 
                                $totalEtab += $fraisscolarite->part_etab ?? 0; 
                                $totalFonds += $fraisscolarite->part_fonds ?? 0; 
                            @endphp
                        @endforeach
                        <tr>
                            <td colspan="2">TOTAL</td>
                            <td>{{ $totalEleves }}</td>
                            <td>{{ number_format($totalPerçu, 0, ',', ' ') }}</td>
                            <td>{{ number_format($totalEtab, 0, ',', ' ') }}</td>
                            <td>{{ number_format($totalFonds, 0, ',', ' ') }}</td>
                            <td></td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="7" style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">Aucune donnée existante.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <br><br>


            <p>
                <span style="font-family: Helvetica; font-weight: bold">Autres ressources (productions et travaux
                    extérieurs)</span>
            </p>

            <table border="1" cellpadding="3" cellspacing="0"
                style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                <thead>
                    <tr>
                        <th>Nature</th>
                        <th>Clients</th>
                        <th>Montant prévisionnels</th>
                        <th>Part établissement</th>
                        <th>Part versée au fond école</th>
                        <th>Observations</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($travauxexterieurs && $travauxexterieurs->count() > 0)
                        @php 
                            $totalMontant = 0; 
                            $totalEtab = 0; 
                            $totalFonds = 0; 
                        @endphp
                        @foreach ($travauxexterieurs as $travauxexterieur)
                            <tr>
                                <td>{{ $travauxexterieur->nature ?? '' }}</td>
                                <td>{{ $travauxexterieur->client ?? '' }}</td>
                                <td>{{ number_format($travauxexterieur->montant_previsionnel ?? 0, 0, ',', ' ') }}</td>
                                <td>{{ number_format($travauxexterieur->part_etab ?? 0, 0, ',', ' ') }}</td>
                                <td>{{ number_format($travauxexterieur->part_fonds ?? 0, 0, ',', ' ') }}</td>
                                <td>{{ $travauxexterieur->observations ?? '' }}</td>
                            </tr>
                            @php 
                                $totalMontant += $travauxexterieur->montant_previsionnel ?? 0; 
                                $totalEtab += $travauxexterieur->part_etab ?? 0; 
                                $totalFonds += $travauxexterieur->part_fonds ?? 0; 
                            @endphp
                        @endforeach
                        <tr>
                            <td>TOTAL</td>
                            <td></td>
                            <td>{{ number_format($totalMontant, 0, ',', ' ') }}</td>
                            <td>{{ number_format($totalEtab, 0, ',', ' ') }}</td>
                            <td>{{ number_format($totalFonds, 0, ',', ' ') }}</td>
                            <td></td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="6" style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">Aucune donnée existante.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <br><br>

            <p>
                <span style="font-family: Helvetica; font-weight: bold">Comité de gestion</span>
            </p>
            <p style="text-decoration:underline; font-weight: bold">Bureau</p>
            @if ($comitegestions && $comitegestions->count() > 0)
                @foreach ($comitegestions as $comitegestion)
                    @if ($comitegestion->libellemembrecomite)
                        <p style="font-weight: bold">{{ $comitegestion->libellemembrecomite }} :</p>
                        <p>{{ $comitegestion->nomprenoms ?? '' }}</p>
                    @endif
                @endforeach
            @else
                <p style="font-weight: bold">Président :</p>
                <p style="font-weight: bold">Vice-Président :</p>
                <p style="font-weight: bold">Secrétaire Général :</p>
                <p style="font-weight: bold">Secrétaire Général Adjoint :</p>
                <p style="font-weight: bold">Trésorier Général :</p>
                <p style="font-weight: bold">Trésorier Général Adjoint :</p>
            @endif
            <br><br>


            <p>
                <span style="font-family: Helvetica; font-weight: bold">Les classes</span>
            </p>

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

                        @foreach ($boursiers as $boursier)
                            <tr style="text-align: center">
                                <td style="height: 35px;">{{ $loop->iteration }}</td>
                                <td>{{ $boursier->denominationclasse ?? '' }}</td>
                                <td>{{ $boursier->effectif_total ?? '' }}</td>
                                <td>{{ $boursier->effectif_gar ?? '' }}</td>
                                <td>{{ $boursier->effectif_fil ?? '' }}</td>
                                <td>{{ $boursier->nombre_boursiers ?? '' }}</td>
                                <td>{{ $boursier->nombre_non_boursiers ?? '' }}</td>
                                <td>{{ $boursier->nombre_affectes ?? '' }}</td>
                                <td>{{ $boursier->nombre_non_affectes ?? '' }}</td>
                                <td>{{ $boursier->libellegp ?? '' }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            @else
                <table border="1" cellpadding="15" cellspacing="0" style="width: 100%; table-layout: fixed;">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Dénomination</th>
                            <th>Effectif total</th>
                            <th>Garçons</th>
                            <th>Filles</th>
                            <th>Boursiers</th>
                            <th>Non boursiers</th>
                            <th>Affectés</th>
                            <th>Non affectés</th>
                            <th>Groupe pédagogique</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="10"
                                style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                                Aucune
                                donnée
                                existante.</td>
                        </tr>
                    </tbody>
                </table>
            @endif

            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Les infrastructures</span>
            </p>

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
                                <td>{{ $infrastructure->obs ?? 'Non renseigné' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <table border="1" cellpadding="15" cellspacing="0" style="width: 100%; table-layout: fixed;">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Libellé</th>
                            <th>Nombre total</th>
                            <th>Capacité</th>
                            <th>Nombre de bureau</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7"
                                style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                                Aucune
                                donnée
                                existante.</td>
                        </tr>
                    </tbody>
                </table>
            @endif

            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Equipements</span>
            </p>

            @if ($nbre_equipements > 0)
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed;font-size: 14px !important; text-align: center;">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Matériel</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipements as $equipement)
                            <tr>
                                <td style="height: 35px;">{{ $loop->iteration }}</td>
                                <td>{{ $equipement->libellemateriel ?? 'Non renseigné' }}</td>
                                <td>{{ $equipement->nombre ?? 'Non renseigné' }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <table border="1" cellpadding="15" cellspacing="0" style="width: 100%; table-layout: fixed;">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Matériel</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5"
                                style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                                Aucune
                                donnée
                                existante.</td>
                        </tr>
                    </tbody>
                </table>
            @endif

            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Activités Sportives</span>
            </p>

            @if ($nbre_activites > 0)
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed;font-size: 14px !important; text-align: center;">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Activités Sportives</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activites as $activite)
                            <tr>
                                <td style="height: 35px;">{{ $loop->iteration }}</td>
                                <td>{{ $activite->libellesport ?? 'Non renseigné' }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <table border="1" cellpadding="15" cellspacing="0" style="width: 100%; table-layout: fixed;">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Activités Sportives</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5"
                                style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                                Aucune
                                donnée
                                existante.</td>
                        </tr>
                    </tbody>
                </table>
            @endif

            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Clubs et Associations</span>
            </p>

            @if ($nbre_associations > 0)
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed;font-size: 14px !important; text-align: center;">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Désignation</th>
                            <th>Objet</th>
                            <th>Nom du responsable</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($associations as $association)
                            <tr>
                                <td style="height: 35px;">{{ $loop->iteration }}</td>
                                <td>{{ $association->designation ?? 'Non renseigné' }}</td>
                                <td>{{ $association->objet ?? 'Non renseigné' }}</td>
                                <td>{{ $association->nomresponsable ?? 'Non renseigné' }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <table border="1" cellpadding="15" cellspacing="0" style="width: 100%; table-layout: fixed;">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Désignation</th>
                            <th>Objet</th>
                            <th>Nom du responsable</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5"
                                style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                                Aucune
                                donnée
                                existante.</td>
                        </tr>
                    </tbody>
                </table>
            @endif

            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Problèmes urgents</span>
            </p>

            @if ($nbre_probleme > 0)
                @foreach ($probleme_urgents as $probleme)
                    <p>
                        {{ $probleme->libelleprobleme ?? 'Problème non spécifié' }}
                    </p>
                @endforeach
            @else
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    R A S
                </p>
            @endif

            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold; text-align: center">Conclusion</span>
            </p>

            @if ($nbre_conclusions > 0)
                @foreach ($conclusions as $conclusion)
                    <p>
                        {{ $conclusion->libelleconclusion ?? 'Conclusion non spécifiée' }}
                    </p>
                @endforeach
            @else
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    R A S
                </p>
            @endif

            <div class="page-break">
                Annexe
            </div>

            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Les apprenants</span>
            </p>

            @if ($nbre_apprenants > 0)
                <table border="1" cellspacing="0"
                    style="width: 100%; table-layout: fixed; font-size: 11px !important;">
                    <thead>
                        <tr>
                            <th style="width: 5%">N°</th>
                            <th style="width: 5%">Sexe</th>
                            <th style="width: 9%">Matricule</th>
                            <th>Nom & Prénoms</th>
                            <th style="width: 8%">Date de naissance</th>
                            <th>Lieu de naissance</th>
                            <th>Nationalité</th>
                            <th>Classe</th>
                            <th>Téléphone</th>
                            <th>Handicap</th>
                            <th style="width: 8%">Type d'handicap</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apprenants as $apprenant)
                            <tr style="text-align: center">
                                <td style="height: 35px;">{{ $loop->iteration }}</td>
                                <td>{{ $apprenant->sexe ?? 'Non renseigné' }}</td>
                                <td>{{ $apprenant->matriculeap ?? 'Non renseigné' }}</td>
                                <td> {{ $apprenant->nom . ' ' . $apprenant->prenoms ?? 'Non renseigné' }}</td>
                                <td>{{ $apprenant->datenaissance }}
                                </td>
                                <td>{{ $apprenant->lieunaissance ?? 'Non renseigné' }}</td>
                                <td>{{ $apprenant->nationalite ?? 'Non renseigné' }}</td>
                                <td>{{ $apprenant->la_classe ?? 'Non renseigné' }}</td>
                                <td>{{ $apprenant->telephone ?? 'Non renseigné' }}</td>
                                <td>{{ $apprenant->libelle_handicap ?? 'Sans handicap' }}</td>
                                <td>{{ $apprenant->libelle_typeshandicap ?? 'Sans handicap' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <table border="1" cellpadding="15" cellspacing="0" style="width: 100%; table-layout: fixed;">
                    <thead>
                        <tr>
                            <th style="width: 5%">N°</th>
                            <th style="width: 5%">Sexe</th>
                            <th>Matricule</th>
                            <th>Nom & Prénoms</th>
                            <th>Date de naissance</th>
                            <th>Lieu de naissance</th>
                            <th>Nationalité</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Handicap</th>
                            <th>Type d'handicap</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="11"
                                style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                                Aucune
                                donnée
                                existante.</td>
                        </tr>
                    </tbody>
                </table>
            @endif

            <br><br>
            <div class="titre-emploi">
                <h3 style="margin: 0; font-size: 16px;">📅 Les emplois du temps des classes</h3>
            </div>

            <div class="legende">
                <div class="legende-item">
                    <span class="legende-couleur" style="background-color: #3498db;"></span>
                    <span>Cours</span>
                </div>
                <div class="legende-item">
                    <span class="legende-couleur" style="background-color: #f8f9fa;"></span>
                    <span>Créneau libre</span>
                </div>
                <div class="legende-item">
                    <span class="legende-couleur" style="background-color: #f1f3f4;"></span>
                    <span>Week-end</span>
                </div>
            </div>

            @foreach ($emploisParClasse as $classe => $emplois)
    <div style="page-break-inside: avoid; margin: 20px 0 40px 0; font-family: Arial, sans-serif;">
        <!-- En-tête avec le nom de la classe -->
        <div style="
            background-color: #000000; 
            color: white; 
            padding: 5px; 
            text-align: center;
            margin: 0 0 0 0;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 1px solid #000;
        ">
            EMPLOI DU TEMPS - {{ strtoupper($classe) }}
        </div>
        
        <!-- Tableau principal -->
        <table border="1" cellspacing="0" cellpadding="0" style="
            width: 100%; 
            border-collapse: collapse; 
            font-size: 8px;
            border: 1px solid #000;
        ">
            <!-- En-têtes des jours -->
            <thead>
                <tr>
                    <th style="
                        width: 10%; 
                        background-color: #000000; 
                        color: white; 
                        padding: 2px; 
                        text-align: center; 
                        border: 1px solid #000;
                        font-weight: bold;
                        font-size: 8px;
                        height: 20px;
                    ">HEURES</th>
                    @foreach(['LUNDI', 'MARDI', 'MERCREDI', 'JEUDI', 'VENDREDI', 'SAMEDI'] as $jour)
                        <th style="
                            background-color: #000000; 
                            color: white; 
                            padding: 2px; 
                            text-align: center; 
                            border: 1px solid #000;
                            font-weight: bold;
                            font-size: 8px;
                            height: 20px;
                        ">{{ $jour }}</th>
                    @endforeach
                </tr>
            </thead>
            
            <tbody>
                @php
                    // Définition des plages horaires
                    $plagesHoraires = [
                        ['08:00', '09:00'],
                        ['09:00', '10:00'],
                        ['10:00', '11:00'],
                        ['11:00', '12:00'],
                        ['12:00', '13:00'],
                        ['13:00', '14:00'],
                        ['14:00', '15:00'],
                        ['15:00', '16:00'],
                        ['16:00', '17:00']
                    ];
                @endphp

                @foreach($plagesHoraires as $horaire)
                    @php
                        $debut = $horaire[0];
                        $fin = $horaire[1];
                        $estPause = ($debut === '12:00');
                    @endphp
                    
                    <tr>
                        <!-- Colonne des heures -->
                        <td style="
                            background-color: #f0f0f0; 
                            text-align: center; 
                            font-weight: bold; 
                            padding: 2px; 
                            border: 1px solid #000;
                            font-size: 8px;
                            height: 25px;
                        ">
                            {{ $debut }}<br>{{ $fin }}
                        </td>
                        
                        <!-- Colonnes des jours -->
                        @foreach(['LUNDI', 'MARDI', 'MERCREDI', 'JEUDI', 'VENDREDI', 'SAMEDI'] as $jour)
                            @if($estPause)
                                <td style="
                                    text-align: center; 
                                    padding: 2px; 
                                    height: 25px; 
                                    vertical-align: middle; 
                                    border: 1px solid #000;
                                    font-size: 8px;
                                    background-color: #f0f0f0;
                                    font-weight: bold;
                                    font-style: italic;
                                ">
                                    PAUSE
                                </td>
                            @else
                                @php
                                    $cours = $emplois->first(function($item) use ($debut, $jour) {
                                        return $item->DEBUT === $debut && !empty($item->$jour);
                                    });
                                @endphp
                                
                                <td style="
                                    text-align: center; 
                                    padding: 1px; 
                                    height: 25px; 
                                    vertical-align: middle; 
                                    border: 1px solid #000;
                                    font-size: 8px;
                                    background-color: white;
                                ">
                                    @if($cours)
                                        <div style="font-weight: bold; line-height: 1.1; font-size: 7px;">
                                            {{ $cours->$jour }}
                                        </div>
                                        @if(isset($cours->salle))
                                            <div style="color: #333; font-size: 6px; margin-top: 1px;">
                                                Salle: {{ $cours->salle }}
                                            </div>
                                        @endif
                                    @endif
                                </td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endforeach

            <br><br>
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Les emplois du temps par professeur</span>
            </p>
            @foreach ($emploisParProf as $nomComplet => $emploisProfs)
                <h2>Professeur : {{ $nomComplet }}</h2>
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed; font-size: 12px !important; text-align: center">
                    <thead>
                        <tr>
                            <th>Horaires</th>
                            <th>Lundi</th>
                            <th>Mardi</th>
                            <th>Mercredi</th>
                            <th>Jeudi</th>
                            <th>Vendredi</th>
                            <th>Samedi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($emploisProfs as $emploisProf)
                            <tr>
                                <td>{{ $emploisProf->DEBUT }} - {{ $emploisProf->FIN }}</td>
                                <td style="{{ empty($emploisProf->LUNDI) ? 'background-color: #d3d3d3;' : '' }}">
                                    {!! nl2br(e($emploisProf->LUNDI)) !!}</td>
                                <td style="{{ empty($emploisProf->MARDI) ? 'background-color: #d3d3d3;' : '' }}">
                                    {!! nl2br(e($emploisProf->MARDI)) !!}</td>
                                <td style="{{ empty($emploisProf->MERCREDI) ? 'background-color: #d3d3d3;' : '' }}">
                                    {!! nl2br(e($emploisProf->MERCREDI)) !!}</td>
                                <td style="{{ empty($emploisProf->JEUDI) ? 'background-color: #d3d3d3;' : '' }}">
                                    {!! nl2br(e($emploisProf->JEUDI)) !!}</td>
                                <td style="{{ empty($emploisProf->VENDREDI) ? 'background-color: #d3d3d3;' : '' }}">
                                    {!! nl2br(e($emploisProf->VENDREDI)) !!}</td>
                                <td style="{{ empty($emploisProf->SAMEDI) ? 'background-color: #d3d3d3;' : '' }}">
                                    {!! nl2br(e($emploisProf->SAMEDI)) !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>

    </div>
</body>

</html>
