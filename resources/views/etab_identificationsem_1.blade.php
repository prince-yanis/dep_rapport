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
      page-break-before: always; /* Saut de page avant */
      page-break-after: always;  /* Saut de page après */
      text-align: center;
      font-size: 24px;
      font-weight: bold;
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
        <div style="width: 35%; text-align: center;">
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
                RAPPORT DE 1ER SEMESTRE DES ETABLISSEMENTS SCOLAIRES PRIVES </h3>

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

            <p style="margin-top: 8.9pt">
                <span style="font-family: Helvetica; vertical-align: 0.5pt">1-7-1 Numéro d'autorisation d'ouverture
                </span>
            </p>


            <p style="margin-top: 7.15pt">
                <span style="font-family: Helvetica; ">1-7-2-1. {{ $etablissements->libelleenseignement }} :
                    <b> {{ $etablissements->numautorisationouverture ?? 'Non renseigné' }} </b> </span>
            </p>
        </div>

        <div>
            <h3>Filières de formations</h3>
            @if ($nbre_filiere_enseignes > 0)
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
                    <thead>
                        <tr>
                            <th style="width: 5%">N°</th>
                            <th>Filière</th>
                            <th>N° autorisation d'ouverture</th>
                            <th>Durée de la formation</th>
                            <th>Diplôme préparé</th>
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
                    <th style="width: 9%">Matricule</th>
                    <th>Nom & Prénoms</th>
                    <th style="width: 8%">Date de naissance</th>
                    <th>Lieu de naissance</th>
                    <th style="width: 5%">Sexe</th>
                    <th>Nationalité</th>
                    <th>Classe</th>
                    <th>Handicap</th>
                    <th>Moyenne</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($apprenants as $classe => $eleves)
                    {{-- Ligne de séparation ou titre de classe --}}
                    <tr style="background-color: #f0f0f0; font-weight: bold;">
                        <td colspan="10" style="text-align: left; padding-left: 10px; font-size: 16px !important;">
                            Classe : {{ $classe }}
                        </td>
                    </tr>
        
                    @foreach ($eleves as $index => $apprenant)
                        <tr style="text-align: center">
                            <td style="height: 35px;">{{ $index + 1 }}</td>
                            <td>{{ $apprenant->matriculeap ?? 'Non renseigné' }}</td>
                            <td>{{ $apprenant->nom . ' ' . $apprenant->prenoms ?? 'Non renseigné' }}</td>
                            <td>{{ $apprenant->datenaissance }}</td>
                            <td>{{ $apprenant->lieunaissance ?? 'Non renseigné' }}</td>
                            <td>{{ $apprenant->sexe ?? 'Non renseigné' }}</td>
                            <td>{{ $apprenant->nationalite ?? 'Non renseigné' }}</td>
                            <td>{{ $apprenant->la_classe ?? 'Non renseigné' }}</td>
                            <td>{{ $apprenant->libelle_handicap ?? 'Sans handicap' }}</td>
                            <td>{{ $apprenant->moyenne1er ?? '' }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
        
            @else
                <table border="1" cellpadding="15" cellspacing="0" style="width: 100%; table-layout: fixed;">
                    <thead>
                        <tr>
                            <th style="width: 5%">N°</th>
                            <th style="width: 9%">Matricule</th>
                            <th>Nom & Prénoms</th>
                            <th style="width: 8%">Date de naissance</th>
                            <th>Lieu de naissance</th>
                            <th style="width: 5%">Sexe</th>
                            <th>Nationalité</th>
                            <th>Classe</th>
                            <th>Handicap</th>
                            {{-- <th style="width: 8%">Type d'handicap</th> --}}
                            <th>Moyenne</th>
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
            <p>
                <span style="font-family: Helvetica; font-weight: bold">Les emplois du temps</span>
            </p>
            @foreach ($emploisParClasse as $classe => $emplois)
                <h2>Classe : {{ $classe }}</h2>
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed; font-size: 12px !important; text-align: center">
                    <thead>
                        <tr>
                            <th>Heure</th>
                            <th>Lundi</th>
                            <th>Mardi</th>
                            <th>Mercredi</th>
                            <th>Jeudi</th>
                            <th>Vendredi</th>
                            <th>Samedi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($emplois as $emploi)
                            <tr>
                                <td>{{ $emploi->DEBUT }} - {{ $emploi->FIN }}</td>
                                <td style="{{ empty($emploi->LUNDI) ? 'background-color: #d3d3d3;' : '' }}">
                                    {!! nl2br(e($emploi->LUNDI)) !!}</td>
                                <td style="{{ empty($emploi->MARDI) ? 'background-color: #d3d3d3;' : '' }}">
                                    {!! nl2br(e($emploi->MARDI)) !!}</td>
                                <td style="{{ empty($emploi->MERCREDI) ? 'background-color: #d3d3d3;' : '' }}">
                                    {!! nl2br(e($emploi->MERCREDI)) !!}</td>
                                <td style="{{ empty($emploi->JEUDI) ? 'background-color: #d3d3d3;' : '' }}">
                                    {!! nl2br(e($emploi->JEUDI)) !!}</td>
                                <td style="{{ empty($emploi->VENDREDI) ? 'background-color: #d3d3d3;' : '' }}">
                                    {!! nl2br(e($emploi->VENDREDI)) !!}</td>
                                <td style="{{ empty($emploi->SAMEDI) ? 'background-color: #d3d3d3;' : '' }}">
                                    {!! nl2br(e($emploi->SAMEDI)) !!}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
