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
        <div>
            <div class="page">
                <h3
                    style="padding:10px 30px; margin: 5px 200px; border: 2px solid black; font-weight: bold; text-align: center;">
                    RAPPORT DE LA RENTREE DES ETABLISSEMENTS SCOLAIRES PRIVES </h3>

                <h3 style="font-weight: bold; text-align: center; margin-top: 50px; text-decoration: underline;">
                    I-IDENTIFICATION
                </h3>
                <br>

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

                <p class="ListParagraph" style="margin-top: 4pt;  font-family: Helvetica">
                    <span style="font-family: Helvetica">Nom et Prénoms du Directeur des études (DE) :
                        I___I___I___I___I___I___I___I___I___I___I___I___I___I</span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="font-family: Helvetica">Cel : I___I___I___I___I___I___I___I___I___I___I</span>
                </p>

                <p class="ListParagraph" style="margin-top: 4pt;  font-family: Helvetica">
                    <span style="font-family: Helvetica">Nom et Prénoms du Correspondant fichier :
                        I___I___I___I___I___I___I___I___I___I___I___I___I___I___I</span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="font-family: Helvetica">Cel : I___I___I___I___I___I___I___I___I___I___I</span>
                </p>

                <p class="ListParagraph" style="margin-top: 4pt;  font-family: Helvetica">
                    <span style="font-family: Helvetica">Nom et Prénoms du SERFE:
                        I___I___I___I___I___I___I___I___I___I___I___I___I___I___I___I___I___I</span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="font-family: Helvetica">Cel : I___I___I___I___I___I___I___I___I___I___I</span>
                </p>

                <p class="ListParagraph" style="margin-top: 4pt;  font-family: Helvetica">
                    <span style="font-family: Helvetica">Nom et Prénoms du Chef de Travaux(Filières industrielles) :
                        I___I___I___I___I___I___I___I___I___I___I</span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="font-family: Helvetica">Cel : I___I___I___I___I___I___I___I___I___I___I</span>
                </p>

                <br>

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


                <p style="margin-top: 8.65pt; font-family: Helvetica; letter-spacing: -0.1pt"> I-5. Autre(s) ordre(s)
                    d'enseignement dans
                    l'établissement
                </p>

                <p style="margin-top: 8.65pt">
                    <span style="font-family: Helvetica; letter-spacing: -0.1pt">I-5-1. Enseignement Supérieur
                        I___I</span>
                </p>

                <p style="margin-top: 8.65pt">
                    <span style="font-family: Helvetica">I-5-2. Enseignement générale I___I si oui,
                        précisez</span>&nbsp;
                    &nbsp;&nbsp; &nbsp;
                    <span style="font-family: Helvetica">1er cycle I___I</span>&nbsp; &nbsp;&nbsp; &nbsp;
                    <span style="font-family: Helvetica">2nd cycle I___I</span>&nbsp; &nbsp;&nbsp; &nbsp;
                    <span style="font-family: Helvetica">3) Aucun I___I </span>&nbsp; &nbsp;&nbsp; &nbsp;
                </p>
                <br>
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
                <p style="margin-top: 6.1pt">
                    <span style="font-family: Helvetica; letter-spacing: -0.1pt; vertical-align: 0.5pt;">I-6-4. Milieu:
                        1)
                        Urbain I___I &nbsp;&nbsp;&nbsp; 2) Rural I___I</span>
                </p>

                <p style="margin-top: 6.1pt">
                    <span style="font-family: Helvetica; vertical-align: 0.5pt">1-6-5. GPS (Coordonnées) :
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
                        :</span>
                </p>
                <p style="margin-top: 7.15pt">
                    <span style="font-family: Helvetica; ">1-7-1-1. {{ $etablissements->libelleenseignement }} :
                        <b> {{ $etablissements->numautorisationcreation ?? 'Non renseigné' }} </b> </span>
                    <span style="font-family: Helvetica; ">Date d'autorisation de création :
                        <b> {{ $etablissements->datecreation ?? 'Non renseigné' }} </b> </span>
                </p>

                {{-- <p style="margin-top: 7.15pt">
                    <span style="font-family: Helvetica; ">1-7-1-2. Professionnel: ……………………… </span>
                    <span style="font-family: Helvetica; ">Date d'autorisation de création :
                        <b> {{$query1->datecreation   ?? 'Non renseigné'}} </b> </span>
                </p> --}}

                <p style="margin-top: 8.9pt">
                    <span style="font-family: Helvetica; vertical-align: 0.5pt">1-7-2. Numéro d'autorisation d'ouverture
                        :</span>
                </p>

                <p style="margin-top: 7.15pt">
                    <span style="font-family: Helvetica; ">1-7-2-1. {{ $etablissements->libelleenseignement }} :
                        <b> {{ $etablissements->numautorisationouverture ?? 'Non renseigné' }} </b> </span>
                    <span style="font-family: Helvetica; ">Date d'autorisation d'ouverture :
                        I__I__I__I__I__I__I__I__I__I </span>
                </p>
            </div>

            <div>
                <h3>Filières enseignées</h3>

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
                                    Aucune donnée
                                    existante.</td>
                            </tr>
                        </tbody>
                    </table>
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
                    <table border="1" cellpadding="15" cellspacing="0"
                        style="width: 100%; table-layout: fixed;">
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
                                    Aucune donnée
                                    existante.</td>
                            </tr>
                        </tbody>
                    </table>
                @endif


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
                                <th>Email</th>
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
                                    <td>{{ Carbon\Carbon::parse($apprenant->datenaissance)->isoFormat('DD MMMM YYYY') }}
                                    </td>
                                    <td>{{ $apprenant->lieunaissance ?? 'Non renseigné' }}</td>
                                    <td>{{ $apprenant->nationalite ?? 'Non renseigné' }}</td>
                                    <td>{{ $apprenant->email ?? 'Non renseigné' }}</td>
                                    <td>{{ $apprenant->telephone ?? 'Non renseigné' }}</td>
                                    <td>{{ $apprenant->handicap ?? 'Non renseigné' }}</td>
                                    <td>{{ $apprenant->typehandicap ?? 'Non renseigné' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <table border="1" cellpadding="15" cellspacing="0"
                        style="width: 100%; table-layout: fixed;">
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
                                    Aucune donnée
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
                    <table border="1" cellpadding="15" cellspacing="0"
                        style="width: 100%; table-layout: fixed;">
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
                            <tr>
                                <td colspan="7"
                                    style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                                    Aucune donnée
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
                    <table border="1" cellpadding="15" cellspacing="0"
                        style="width: 100%; table-layout: fixed;">
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
                            <tr>
                                <td colspan="5"
                                    style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                                    Aucune donnée
                                    existante.</td>
                            </tr>
                        </tbody>
                    </table>
                @endif


                <br><br>
                <p>
                    <span style="font-family: Helvetica; font-weight: bold">Besoin en formation</span>
                </p>

                @if ($nbre_besoins > 0)
                    <table border="1" cellpadding="8" cellspacing="0"
                        style="width: 100%; table-layout: fixed;font-size: 14px !important; text-align: center;">
                        <thead>
                            <tr>
                                <th style="width: 3%;">N°</th>
                                <th>Type d'autorisation</th>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($besoins as $besoin)
                                <tr>
                                    <td style="height: 35px;">{{ $loop->iteration }}</td>
                                    <td>{{ $besoin->typeautorisation ?? 'Non renseigné' }}</td>
                                    <td>{{ $besoin->nombre ?? 'Non renseigné' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <table border="1" cellpadding="15" cellspacing="0"
                        style="width: 100%; table-layout: fixed;">
                        <thead>
                            <tr>
                                <th style="width: 3%;">N°</th>
                                <th>Type d'autorisation</th>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3"
                                    style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                                    Aucune donnée
                                    existante.</td>
                            </tr>
                        </tbody>
                    </table>
                @endif
                <br><br>
                <p>
                    <span style="font-family: Helvetica; font-weight: bold">Conclusion</span>
                </p>

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
                    <table border="1" cellpadding="15" cellspacing="0"
                        style="width: 100%; table-layout: fixed;">
                        <thead>
                            <tr>
                                <th style="width: 3%;">N°</th>
                                <th>Contenu</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2"
                                    style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                                    Aucune donnée
                                    existante.</td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
</body>

</html>
