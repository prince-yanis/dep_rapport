<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta name="generator" content="Aspose.Words for .NET 24.8.0" />
    <title></title>
    <style type="text/css">
    * {
    box-sizing: border-box;
}
        body {
            font-family: "Times New Roman";
            font-size: 12px;
        }

        .BalloonText {
            font-family: Tahoma;
            font-size: 8pt;
            -aw-style-name: balloon-text;
        }

        .BodyText {
            widows: 0;
            orphans: 0;
            font-family: "Calisto MT";
            font-size: 8.5pt;
            font-weight: bold;
            -aw-style-name: body-text;
        }

        .page-break {
            page-break-after: always;
        }

        .Default {
            widows: 0;
            orphans: 0;
            font-size: 12pt;
            color: #000000;
        }

        .Footer {
            font-size: 12pt;
            -aw-style-name: footer;
        }

        .Header {
            font-size: 12pt;
            -aw-style-name: header;
        }

        .ListParagraph {
            margin-left: 65.75pt;
            text-indent: -18.3pt;
            widows: 0;
            orphans: 0;
            font-family: "Calisto MT";
            font-size: 11pt;
            -aw-style-name: list-paragraph;
        }

        .Standard {
            margin-bottom: 8pt;
            font-family: Calibri;
            font-size: 11pt;
        }

        span.CorpsdetexteCar {
            font-family: "Calisto MT";
            font-size: 8.5pt;
            font-weight: bold;
        }

        span.En-tteCar {
            font-size: 12pt;
        }

        span.PageNumber {
            -aw-style-name: page-number;
        }

        span.PieddepageCar {
            font-size: 12pt;
        }

        span.TextedebullesCar {
            font-family: Tahoma;
            font-size: 8pt;
        }

        .Grilledutableau1 {}

        .Grilledutableau2 {}

        .TableGrid {}

        .espacetable {
            width: 84.7pt;
            border-style: solid;
            border-width: 0.75pt;
            padding-right: 5.03pt;
            padding-left: 5.03pt;
            vertical-align: top;
            -aw-border: 0.5pt single;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3,
        h4 {
            color: #333;
            /* border-bottom: 2px solid #f0f0f0; */
            padding-bottom: 5px;
            margin-top: 20px;
        }



        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        td {
            border: 1px solid #000 !important;
            padding: 2px 4px;
            /* 👈 ESPACE INTERNE */
            text-align: center;
            line-height: 1.4;
        }
    </style>
</head>

<body>
    <div>
        <h3
            style="padding:10px 30px; margin: 5px 400px; border: 2px solid black; font-weight: bold; text-align: center;">
            FICHE DE SUIVI DES ETABLISSEMENTS SCOLAIRES PRIVES </h3>

        <p style="font-size: 16pt">
            <span
                style="
                        font-family: Helvetica;
                        font-weight: bold;
                        -aw-import: ignore; ">&#xa0;</span>
        </p>
        <h3 style="font-weight: bold; text-align: center; margin-top: 50px; text-decoration: underline;">
            I-IDENTIFICATION</h3>
        <br>

        <p style="margin-top: 7.1pt;font-family: Helvetica; font-weight: bold">I-1. Dénominationdel'établissement(en
            entier et en lettres capitales) </p>
        <p style="margin-top: 8.65pt">
            <span style="font-family: Helvetica; letter-spacing: -0.1pt"> <b>{{ $query1->denominationetab }}</b>
                &nbsp;&nbsp;.Sigle: {{ $query1->sigle ?? 'Non renseigné' }} </span>
        </p>

        <p style="margin-top: 7.1pt;font-family: Helvetica; font-weight: bold">I-2. Contacts de l'établissement </p>
        <br>

        <p class="ListParagraph" style="margin-top: 1.8pt; margin-left: 18.3pt; font-family: Helvetica">
            <span style="font-family: Helvetica">Téléphone de l'établissement Cel :
                <b> {{ $query1->telephone ?? 'Non renseigné' }}</b></span>&nbsp;&nbsp;&nbsp;&nbsp;
            <span style="font-family: Helvetica">Fixe : {{ $query1->telephone ?? 'Non renseigné' }}</span>
        </p>

        <p class="ListParagraph" style="margin-top: 4pt; margin-left: 18.3pt; font-family: Helvetica">
            <span style="font-family: Helvetica">Nom et Prénoms du Fondateur:
                {{ $query1->nomfondateur ?? 'Non renseigné' }}
        </p>

        <p class="ListParagraph" style="margin-top: 4pt; margin-left: 18.3pt; font-family: Helvetica">
            <span style="font-family: Helvetica">Nom et Prénoms du Directeur des études (DE) :
                I___I___I___I___I___I___I___I___I___I___I___I___I___I</span>&nbsp;&nbsp;&nbsp;&nbsp;
            <span style="font-family: Helvetica">Cel : {{ $query1->contact_de ?? 'Non renseigné' }}</span>
        </p>

        <p class="ListParagraph" style="margin-top: 4pt; margin-left: 18.3pt; font-family: Helvetica">
            <span style="font-family: Helvetica">Nom et Prénoms du Correspondant fichier :
                I___I___I___I___I___I___I___I___I___I___I___I___I___I___I</span>&nbsp;&nbsp;&nbsp;&nbsp;
            <span style="font-family: Helvetica">Cel : {{ $query1->contact_cf ?? 'Non renseigné' }}</span>
        </p>

        <p class="ListParagraph" style="margin-top: 4pt; margin-left: 18.3pt; font-family: Helvetica">
            <span style="font-family: Helvetica">Nom et Prénoms du SERFE:
                I___I___I___I___I___I___I___I___I___I___I___I___I___I___I___I___I___I</span>&nbsp;&nbsp;&nbsp;&nbsp;
            <span style="font-family: Helvetica">Cel : {{ $query1->contact_serfe ?? 'Non renseigné' }}</span>
        </p>

        <p class="ListParagraph" style="margin-top: 4pt; margin-left: 18.3pt; font-family: Helvetica">
            <span style="font-family: Helvetica">Nom et Prénoms du Chef de Travaux(Filières industrielles) :
                I___I___I___I___I___I___I___I___I___I___I</span>&nbsp;&nbsp;&nbsp;&nbsp;
            <span style="font-family: Helvetica">Cel : {{ $query1->contact_ct ?? 'Non renseigné' }}</span>
        </p>


        <p style="margin-top: 8.65pt;font-family: Helvetica; letter-spacing: -0.1pt;">
            I-3. Ordre d'enseignement de l'établissement:
            <span style="font-family: Helvetica; letter-spacing: -0.1pt; font-weight: normal !important;">
                <b>{{ $query1->libelleenseignement }}</b></span>

        </p>

        <p style="margin-top: 8.65pt; font-family: Helvetica;">
            I-4. Code de L'établissement :
            <span style="font-family: Helvetica; letter-spacing: -0.1pt"> <b>{{ $query1->code }}</b></span> &nbsp;

        </p>
        <p style="margin-top: 8.65pt; font-family: Helvetica; letter-spacing: -0.1pt"> I-5. Autre(s) ordre(s)
            d'enseignement dans l'établissement
        </p>

        <p style="margin-top: 8.65pt">
            <span style="font-family: Helvetica; letter-spacing: -0.1pt">I-5-1. Enseignement Supérieur I___I</span>
        </p>

        <p style="margin-top: 8.65pt">
            <span style="font-family: Helvetica">I-5-2. Enseignement générale I___I si oui, précisez</span>&nbsp;
            &nbsp;&nbsp; &nbsp;
            <span style="font-family: Helvetica">1er cycle I___I</span>&nbsp; &nbsp;&nbsp; &nbsp;
            <span style="font-family: Helvetica">2nd cycle I___I</span>&nbsp; &nbsp;&nbsp; &nbsp;
            <span style="font-family: Helvetica">3 Aucun I___I </span>&nbsp; &nbsp;&nbsp; &nbsp;
        </p>

        <p style="margin-top: 5.25pt">
            <span style="font-family: Helvetica; font-weight: bold">I-6. Localisation</span>
        </p>
        <p style="margin-top: 8pt">
            <span style="font-family: Helvetica">I-6-1. Direction régionale : <b>
                    {{ $query1->denominationdr ?? 'Non renseigné' }} </b></span>
        </p>
        <p style="margin-top: 10pt">
            <span style="font-family: Helvetica">Départementale : <b> {{ $query1->denominationdd ?? 'Non renseigné' }}
                </b></span>
        </p>
        <p style="margin-top: 6.75pt">
            <span style="font-family: Helvetica; letter-spacing: -0.1pt">I-6-2.
                Commune : <b> {{ $query1->denominationcommune ?? 'Non renseigné' }} </b> &nbsp; &nbsp;.Ville : <b>
                    {{ $query1->denominationdepartement ?? 'Non renseigné' }} </b></span>
        </p>
        <p style="margin-top: 6.75pt">
            <span style="font-family: Helvetica; letter-spacing: -0.1pt">I-6-3. Quartier :
                <b> {{ $query1->localisation ?? 'Non renseigné' }} </b> </span>
        </p>

        <p style="margin-top: 6.1pt">
            <span style="font-family: Helvetica; vertical-align: 0.5pt">1-6-4. GPS (Coordonnées)
                : <b> {{ $query1->latitude ?? 'Pas' }} , {{ $query1->longitude ?? 'indiqué' }}</b></span>
        </p>
        <p style="margin-top: 8.9pt">
            <span
                style="
                        font-family: Helvetica;
                        font-weight: bold;
                        vertical-align: 0.5pt;
                    ">1-7
                Numéros d'identification</span>
        </p>
        <p style="margin-top: 8.9pt">
            <span style="font-family: Helvetica; vertical-align: 0.5pt">1-7-1 Numéro d'autorisation de création :</span>
        </p>
        <p style="margin-top: 7.15pt">
            <span style="font-family: Helvetica; ">1-7-1-1. {{ $query1->libelleenseignement }} :
                <b> {{ $query1->numautorisationcreation ?? 'Non renseigné' }} </b> </span>
            <span style="font-family: Helvetica; ">Date d'autorisation de création :
                <b> {{ $query1->datecreation ?? 'Non renseigné' }} </b> </span>
        </p>

        <p style="margin-top: 8.9pt">
            <span style="font-family: Helvetica; vertical-align: 0.5pt">1-7-2. Numéro d'autorisation d'ouverture
                :</span>
        </p>

        <p style="margin-top: 7.15pt">
            <span style="font-family: Helvetica; ">1-7-2-1. {{ $query1->libelleenseignement }} :
                <b> {{ $query1->numautorisationouverture ?? 'Non renseigné' }} </b> </span>
        </p>

        {{-- <p style="margin-top: 7.15pt">
            <span style="font-family: Helvetica; ">1-7-2-2. Professionnel: ……………………… </span>
            <span style="font-family: Helvetica; ">Date d'autorisation d'ouverture :
                I__I__I__I__I__I__I__I__I__I </span>
        </p> --}}
        <br><br>

        <h3>1-8 Filières/séries autorisées :</h3>
        {{-- @php
            $groupedFilieres = $filiere_enseignes->groupBy('libelleenseignement');
        @endphp --}}

        {{-- @if ($nbre_filiere_enseignes > 0) --}}
        <table border="1" cellpadding="0" cellspacing="0"
            style="width: 100%; table-layout: fixed; text-align: center; font-size: 13px !important;">
            <thead>
                <tr>
                    <th>Ordre d'enseignement</th>
                    <th>Filières / Séries</th>
                    <th>Statut</th>
                    <th>Diplômes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groupedFilieres as $ordre => $filieres)
                    @foreach ($filieres as $index => $filiere)
                        <tr>
                            @if ($index === 0)
                                <td rowspan="{{ $filieres->count() }}">
                                    {{ $ordre }}
                                </td>
                            @endif

                            <td>{{ $filiere['libellefiliere'] }}</td>
                            <td>{{ $filiere['observation'] }}</td>
                            <td>{{ $filiere['diplomeprepares']->join(', ') }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>


        </table>

        <br><br>


        <p
            style="font-family: Helvetica;
                        font-weight: bold;
                        text-decoration: underline; text-align: center
                    ">
            II-GESTION ADMINISTRATIVE</p>
        <br>
        <p>
            <span style="font-family: Helvetica; font-weight: bold">II-1 Ressources Humaines</span>
        </p>
        @php $counter = 1; @endphp
        @foreach ($groupedPersonnels as $type => $personnels)
            <p>
                <span style="font-family: Helvetica; font-weight: bold"> II-1-{{ $counter }} Personnel
                    {{ $type }}</span>
            </p>

            <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; table-layout: fixed;">
                <tr>
                    <th style=" text-align: center;"></th>
                    <th style=" text-align: center;">OUI</th>
                    <th style=" text-align: center;">NON</th>
                    <th style=" text-align: center;">Effectif</th>
                    <th style=" text-align: center;">Nombre Autorisés</th>
                    <th style=" text-align: center;">Nombre Non Autorisés</th>
                </tr>
                @foreach ($personnels as $personnel)
                    <tr>
                        <td style="">{{ $personnel->libellefonction }}</td>
                        {{-- OUI --}}
                        <td style="text-align:center;">
                            @if ($personnel->effectif > 0)
                                X
                            @endif
                        </td>

                        {{-- NON --}}
                        <td style="text-align:center;">
                            @if ($personnel->effectif <= 0)
                                X
                            @endif
                        </td>
                        <td>{{ $personnel->effectif }}</td>
                        <td>
                            <{{ $personnel->autorise }} </td>
                        <td>{{ $personnel->effectif - $personnel->autorise }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="7" style="text-align: left;"><strong>Observations Partielle
                            :</strong> {{ $personnel->observationpartielles }}</td>
                </tr>
            </table>
            @php $counter++; @endphp
        @endforeach

        <br>
        <p>
            <span style="font-family: Helvetica; font-weight: bold">II-2 Communication</span>
        </p>
        <br>
        <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; table-layout: fixed;">
            <tr>
                <th></th>
                <th>DECLINAISON</th>
                <th>OUI</th>
                <th>NON</th>
                <th>OBSERVATION</th>
            </tr>
            <tr>

            </tr>
            <tr>
                <td>Planification</td>
                <td>Matrice d'action</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Réunions</td>
                <td>Réunions de direction</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td rowspan="3">Rapports </td>
                <td>Rapport de rentrée</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Rapport du 1er semestre</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Rapport du 2ème semestre ou de fin d'année</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <td colspan="5">OBSERVATIONS PARTIELLES :</td>
            </tr>
        </table>

        <br><br>



        <p style="text-align: center">
            <span
                style="
                        font-family: Helvetica;
                        font-weight: bold;
                        text-decoration: underline;
                    ">III-
                INFRASTRUCTURES ET EQUIPEMENTS</span>
        </p>

        <br><br>
        <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; table-layout: fixed;">
            <tr>
                <th colspan="6">BUREAUX ADMINISTRATIFS ET EQUIPEMENTS</th>
            </tr>
            <tr>
                <th rowspan="2">EQUIPEMENTS</th>
                <th rowspan="2">OUI</th>
                <th rowspan="2">NON</th>
                <th rowspan="2">NOMBRE</th>
                <th colspan="2">ETAT DES EQUIPEMENTS</th>
            </tr>
            <tr>
                <th>Fonctionnels</th>
                <th>Non Fonctionnels</th>
            </tr>
            <tr>
                <td>Bureaux du personnel</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Mobiliers de bureau</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Ordinateurs</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Imprimantes</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Connexion Internet</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <th colspan="6">SALLES DE COURS ORDINAIRE</th>
            </tr>
            <tr>
                <th rowspan="2">EQUIPEMENTS</th>
                <th rowspan="2">OUI</th>
                <th rowspan="2">NON</th>
                <th rowspan="2">NOMBRE</th>
                <th colspan="2">ETAT DES EQUIPEMENTS</th>
            </tr>
            <tr>
                <th>Fonctionnels</th>
                <th>Non Fonctionnels</th>
            </tr>
            <tr>
                <td>Disponibles</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <th colspan="6">SALLES SPECIALISEES/ EQUIPEMENTS</th>
            </tr>
            <tr>
                <td>Salles informatiques</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Salles informatiques climatisées</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Salles machines ou ateliers</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Salles multimédia</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Autres salles</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th colspan="6">INFRASTRUCTURES SOCIALES, SPORTIVES ET RECREATIVES</th>
            </tr>
            <tr>
                <td>Bibliothèque</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Infirmerie</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Terrain de sport</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Préau ou aire(s) de repos</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Internat</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Cantine</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th colspan="6">OBSERVATIONS PARTIELLES</th>
            </tr>
        </table>
        <div class="page-break"></div>
        <br>
        <p style="text-align: center; font-weight: bold;text-decoration: underline">
            IV-GESTION PEDAGOGIQUE ET
            RESULTATS SCOLAIRES</p>

        <br>
        <table>
            <tr>
                <td rowspan="{{ $groupedPedagogiques->flatten()->count() + 1 }}" style="width: 10%;">
                    <strong>{{ $groupedPedagogiques->first()->first()->libellerubrique }}</strong>
                </td>
                <td style="width: 10%;"></td>
                <td style="width: 40%;">DECLINAISONS</td>
                <td style="width: 8%;">OUI</td>
                <td style="width: 8%;">NON</td>
                <td style="width: 10%;">OBSERVATIONS</td>
            </tr>
            @foreach ($groupedPedagogiques as $sousRubrique => $items)
                @foreach ($items as $index => $item)
                    <tr>
                        @if ($index === 0)
                            <td rowspan="{{ count($items) }}" width="20%">
                                <strong>{{ $sousRubrique }}</strong>
                            </td>
                        @endif

                        <td width="40%">{{ $item->libelleitems }}</td>

                        <td width="8%" align="center">
                            {{ $item->existence == '1' ? 'X' : '' }}
                        </td>

                        <td width="8%" align="center">
                            {{ $item->existence == '0' ? 'X' : '' }}
                        </td>

                        <td width="10%">
                            {{ $item->observations }}
                        </td>
                    </tr>
                @endforeach
            @endforeach

            <tr>
                <td colspan="2" rowspan="4">
                    RESULTATS SCOLAIRES DES TROIS(03) DERNIERES ANNEES
                </td>
                <td>ANNEES SCOLAIRES</td>
                <td>NOMBRE CANDIDATS PRESENTES</td>
                <td>ADMIS</td>
                <td>TAUX DE REUSSITE</td>
            </tr>
            @foreach ($resultats_scolaires as $resultats)
                <tr>
                    <td>{{ $resultats->libelleanneescolaire }}</td>
                    <td>{{ $resultats->present }}</td>
                    <td>{{ $resultats->admis }}</td>
                    <td>{{ $resultats->taux }} %</td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="6">OBSERVATIONS PARTIELLES</td>
                </tr>
                <tr>
                    <td colspan="6">{{ $resultats->observationpartielles }}</td>
                </tr>
        </table>


        <p style="text-align: center">
            <span style="font-family: Helvetica; font-weight: bold; text-decoration: underline;">V- EFFECTIFS ET STATUT
                DES ELEVES DE L'ANNEE EN COURS</span>
        </p>

        <br> <br>
        <table border="1" cellspacing="0" cellpadding="0" style="text-align: center">
            <thead>
                <tr>
                    <th rowspan="2">Effectifs présents</th>
                    <th>Élèves affectés</th>
                    <th>Élèves non affectés</th>
                    <th rowspan="2">Total</th>
                </tr>
                <tr>
                    <th colspan="2"> <b>{{ $query1->libelleenseignement }}</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($effectifs as $item)
                    <tr>
                        <td><b>{{ $item->libelleniveau }}</b></td>
                        <td><b>{{ $item->nbreaffecte }}</b></td>
                        <td><b>{{ $item->nbrenonaffecte }}</b></td>
                        <td><b>{{ $item->total }}</b></td>
                    </tr>
                @endforeach
                <tr>
                    <td>Total</td>
                    <td>{{ $nbreAffectes }}</td>
                    <td>{{ $nbreNonAffectes }}</td>
                    <td>{{ $totalEffectifs }}</td>
                </tr>
            </tbody>
        </table>

        <br><br><br>
        <p style="text-align: center">
            <span style=" font-family: Helvetica;font-weight: bold; text-decoration: underline; ">VI- GESTION
                FINANCIERE ET JURIDIQUE</span>
        </p>

        <br><br>
        <table border="1" cellpadding="0" cellspacing="0">

            <tr>
                <td rowspan="9">GESTION FINANCIERE ET JURIDIQUE</td>
                <th>DECLINAISONS</th>
                <th>OUI</th>
                <th>NON</th>
                <th>OBSERVATIONS</th>
            </tr>
            <tr>
                <td>L'établissement a les autorisations et agréments nécessaires à son fonctionnement</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement a un registre fiscal</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement a une fiche de déclaration à la CNPS (Préciser le nombre de personnes déclarées et
                    le quota en observation)</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement respecte la proportion d'enseignants permanents imposée > ou = à 30%</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement a un récépissé de cotisation FDFP (Taxes d'apprentissage)</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement respecte la convention collective (Taux horaire, salaires, congés……)</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Le personnel dispose d'un bulletin de paie mensuel</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement dispose des contrats de travail du personnel </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th colspan="6">OBSERVATIONS PARTIELLES :PAS D'ELEVES AU PROFESSIONNEL :</th>

            </tr>

        </table>
        <div class="page-break"></div>

        <p style="text-align: center">
            <span style=" font-family: Helvetica;font-weight: bold; text-decoration: underline; ">VI- RELATION AVEC LE
                MILIEU PROFESSIONNEL (FP)</span>
        </p>

        <br><br>
        <table border="1" cellspacing="0" cellpadding="0">
            <tr>
                <td rowspan="7">INSERTION PROFESSIONNELLE ET SUIVI DES DIPLÔMES</td>
                <th>DECLINAISONS</th>
                <th>OUI</th>
                <th>NON</th>
                <th>OBSERVATIONS</th>
            </tr>
            <tr>
                <td>L'établissement a des conventions de partenariat avec des entreprises de la branche professionnelle
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th colspan="5">Les différents partenaires :</th>
            </tr>
            <tr>
                <td>L'établissement dispose d'une cartographie des entreprises</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Stage d'immersion des enseignants</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Stage pratique des apprenants en entreprises</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement dispose d'un répertoire des diplômés</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <th colspan="6">OBSERVATIONS PARTIELLES :</th>

            </tr>

        </table>

        <div class="page-break"></div>

        <p style="text-align: center; line-height: 150%">
            <span style="font-family: Helvetica; font-weight: bold;text-decoration: underline;">VII- ENVIRONNEMENT-
                SECURITE - HYGIENE ET SANTE</span>
        </p>
        <br><br>

        <table border="1" cellspacing="0" cellpadding="0">
            <tr>
                <td rowspan="25">ENVIRONNEMENT SECURITE HYGIENE SANTE</td>
                <th>DECLINAISONS</th>
                <th>OUI</th>
                <th>NON</th>
                <th>OBSERVATIONS</th>
            </tr>
            <tr>
                <td>Les voies d'accès sont praticables en voiture en toute saison</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td> L'établissement à des panneaux d'indication</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Les voies d'accès sont éclairées</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement dispose de clôture avec portail sécurisé </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement a un gardien à l'entrée</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement dispose d'extincteurs fonctionnels et suivis</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement dispose d'entrée réservée aux élèves et aux piétons</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement est propre </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Les murs sont peints </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>DECLINAISONS</th>
                <th>OUI</th>
                <th>NON</th>
                <th>OBSERVATIONS</th>
            </tr>

            <tr>
                <td>L'établissement ne subit pas de nuisances (sonore, visuelle et olfactive)</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement dispose d'un cadre propice à l'apprentissage</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Les murs des bâtiments ne sont pas fissurés</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement dispose d'une infirmerie fonctionnelle avec des médicaments d'urgence</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement a un contrat de consultation avec un médecin</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement a des sanitaires fonctionnels par genre et en nombre suffisant</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement a des panneaux de sensibilisation des élèves et stagiaires aux mesures d'hygiène
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement dispose de poubelles en quantité suffisante</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement dispose de toilettes propres en quantité suffisante</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Les toilettes sont éloignées des salles de cours</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Les toilettes des filles et des garçons sont séparées</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement dispose de points d'eau potable fonctionnels</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement dispose de points d'eau suffisants</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L'établissement tient compte des apprenants en situation de handicap</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <th colspan="6">OBSERVATIONS PARTIELLES :</th>

            </tr>

        </table>

        <br><br> <br>

        <table border="1">
            <thead style="text-align: center;">
                <tr style="text-align: center;">
                    <th>NOM ET PRENOMS DU REPRESENTANT DE L'ETABLISSEMENT</th>
                    <th>FONCTION</th>
                    <th>CONTACT/E-MAIL</th>
                    <th>DATE DE LA VISITE</th>
                    <th>SIGNATURE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <br>
        <br>

        <br>
        <br>
        <p style="text-align: center; font-size: 14pt">
            <span style="font-family: Helvetica; font-weight: bold;text-decoration: underline;">LES PARTICIPANTS A LA
                MISSION
            </span>
        </p>
        <br>
        <br>
        <br>
        <table border="1">
            <thead style="text-align: center;">
                <tr style="text-align: center;">
                    <th>STRUCTURE</th>
                    <th>NOM ET PRÉNOMS</th>
                    <th>DATE</th>
                    <th>CONTACTS et E-MAIL</th>
                    <th>SIGNATURE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>METFPA / DEEP</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>METFPA / DEEP</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>METFPA / DR / DD</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

            </tbody>
        </table>
    </div>
</body>

</html>
