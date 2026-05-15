<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <title></title>

    <style type="text/css">
        body { font-family: Helvetica, Arial, sans-serif; font-size: 12px; }

        h2 { font-size: 15px; font-weight: bold; text-align: center; text-decoration: underline; margin-top: 20px; }
        h3 { font-size: 13px; font-weight: bold; }

        th {
            background-color: #0856ba;
            text-align: center;
            font-size: 11px;
            color: #fff;
            padding: 5px 4px;
        }
        td {
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
            font-size: 11px;
            padding: 4px;
        }
        table { border-collapse: collapse; width: 100%; margin-bottom: 10px; }

        .page { page-break-after: always; }
        .page-break { page-break-before: always; }

        .section-title {
            font-weight: bold;
            font-size: 13px;
            margin-top: 14px;
            margin-bottom: 4px;
        }
        .no-data {
            color: #ed7d31;
            font-weight: bold;
            font-style: italic;
            text-align: center;
        }
        .entete-left  { width: 35%; float: left; }
        .entete-right { width: 65%; float: right; text-align: center; }
        .clearfix::after { content: ""; display: table; clear: both; }
    </style>
</head>

<body>

{{-- ================================================================
     PAGE 1 — EN-TETE + IDENTIFICATION
     ================================================================ --}}
<div class="page">

    {{-- En-tête --}}
    <div class="clearfix" style="margin-bottom: 20px;">
        <div class="entete-left">
            <p style="margin:0; font-weight:bold;">DIRECTION GENERALE<br>DE LA FORMATION INITIALE</p>
            <p style="margin:4px 0;">-------------------</p>
            <p style="margin:0; font-weight:bold;">DIRECTION<br>DES ETABLISSEMENTS PUBLICS</p>
            <p style="margin:4px 0;">-------------------</p>
        </div>
        <div class="entete-right">
            <img src="https://formation-professionnelle.gouv.ci/wp-content/uploads/2023/06/LOGO-SITE-02-1.png" height="110">
        </div>
    </div>

    <h3 style="padding:10px 30px; border: 2px solid black; text-align:center; font-size:14px;">
        RAPPORT DE FIN D'ANNÉE DE FORMATION {{ date('Y') }}-{{ date('Y') + 1 }}
    </h3>

    <p style="font-weight:bold; margin-top:14px;">ETABLISSEMENT :
        {{ $etablissements->denominationetab ?? '....................................' }}
    </p>

    {{-- SOMMAIRE --}}
    <h2>SOMMAIRE</h2>
    <p>INTRODUCTION</p>
    <p>1 - PRESENTATION DE L'ETABLISSEMENT ET DES FILIERES DE FORMATION</p>
    <p>&nbsp;&nbsp;&nbsp;- Présentation de l'établissement</p>
    <p>&nbsp;&nbsp;&nbsp;- Filières et durée de formation</p>
    <p>&nbsp;&nbsp;&nbsp;- Nombre de classes par filière</p>
    <p>2 - LES EFFECTIFS DU PERSONNEL</p>
    <p>&nbsp;&nbsp;&nbsp;- Personnels Administratifs, d'encadrement et autres</p>
    <p>&nbsp;&nbsp;&nbsp;- Personnels enseignants</p>
    <p>&nbsp;&nbsp;&nbsp;- Besoins en personnels Administratifs, d'encadrement et autres</p>
    <p>&nbsp;&nbsp;&nbsp;- Besoins en personnels enseignants</p>
    <p>3 - EFFECTIFS ET SITUATION DES APPRENANTS</p>
    <p>4 - RESULTATS SCOLAIRES</p>
    <p>&nbsp;&nbsp;&nbsp;- Résultats de fin d'année</p>
    <p>&nbsp;&nbsp;&nbsp;- Résultats aux examens scolaires</p>
    <p>&nbsp;&nbsp;&nbsp;- Indicateurs de performance</p>
    <p>5 - ETAT DES INFRASTRUCTURES</p>
    <p>6 - BESOINS EN MATERIELS ET EQUIPEMENTS</p>
    <p>7 - GESTION FINANCIERE</p>
    <p>8 - ACTIVITES EXTRA-SCOLAIRES</p>
    <p>9 - DIFFICULTES RENCONTREES ET SUGGESTIONS</p>
    <p>10 - PRÉVISIONS / PERSPECTIVES POUR L'ANNÉE DE FORMATION SUIVANTE</p>
    <p>CONCLUSION GENERALE</p>
    <p>ANNEXES</p>

</div>

{{-- ================================================================
     PAGE 2 — IDENTIFICATION
     ================================================================ --}}
<div class="page">
    <h2>I - IDENTIFICATION</h2>

    <p><strong>I-1. Dénomination de l'établissement (en entier et en lettres capitales)</strong></p>
    <p><strong>{{ $etablissements->denominationetab ?? 'Non renseigné' }}</strong>
        &nbsp;&nbsp; Sigle : {{ $etablissements->sigle ?? 'Non renseigné' }}</p>

    <p><strong>I-2. Contacts de l'établissement</strong></p>
    <p>Téléphone Cel : <strong>{{ $etablissements->contact ?? 'Non renseigné' }}</strong>
       &nbsp;&nbsp; Fixe : _______________</p>
    <p>Nom et Prénoms du Fondateur : <strong>{{ $etablissements->nomfondateur ?? 'Non renseigné' }}</strong></p>

    <p>I-3. Ordre d'enseignement : <strong>{{ $etablissements->libelleenseignement ?? 'Non renseigné' }}</strong></p>
    <p>I-4. Code de l'établissement : <strong>{{ $etablissements->code ?? 'Non renseigné' }}</strong></p>

    <p><strong>I-6. Localisation</strong></p>
    <p>I-6-1. Direction régionale / département : <strong>{{ $etablissements->denominationdd ?? 'Non renseigné' }}</strong></p>
    <p>I-6-2. Commune : <strong>{{ $etablissements->denominationcommune ?? 'Non renseigné' }}</strong></p>
    <p>I-6-3. Quartier : <strong>{{ $etablissements->localisation ?? 'Non renseigné' }}</strong></p>
    <p>I-6-4. GPS : <strong>{{ $etablissements->latitude ?? '—' }}, {{ $etablissements->longitude ?? '—' }}</strong></p>

    <p><strong>I-7. Numéros d'identification</strong></p>
    <p>I-7-1. Numéro d'autorisation de création :
        <strong>{{ $etablissements->numautorisationcreation ?? 'Non renseigné' }}</strong></p>
    <p>I-7-2. Numéro d'autorisation d'ouverture :
        <strong>{{ $etablissements->numautorisationouverture ?? 'Non renseigné' }}</strong></p>
</div>

{{-- ================================================================
     PAGE 3 — FILIERES + CLASSES + PERSONNELS
     ================================================================ --}}
<div class="page">

    {{-- 1.2 Filières et durée de formation --}}
    <h2>1 - PRESENTATION DE L'ETABLISSEMENT ET DES FILIERES</h2>
    <p class="section-title">1.2. Filières et durée de formation</p>

    <table border="1" cellspacing="0">
        <thead>
            <tr>
                <th style="width:4%">N°</th>
                <th>FILIERES</th>
                <th>DIPLÔMES PREPARES</th>
                <th>DUREE DES ETUDES</th>
                <th>DEBOUCHES</th>
                <th>OBSERVATIONS</th>
            </tr>
        </thead>
        <tbody>
            @if($nbre_filiere_enseignes > 0)
                @foreach($filiere_enseignes as $fe)
                <tr>
                    <td style="text-align:center">{{ $loop->iteration }}</td>
                    <td>{{ $fe->libellefiliere ?? '' }}</td>
                    <td>{{ $fe->libellediplome ?? '' }}</td>
                    <td style="text-align:center">{{ $fe->dureeformation ?? '' }}</td>
                    <td>{{ $fe->debouches ?? '' }}</td>
                    <td>{{ $fe->observations ?? '' }}</td>
                </tr>
                @endforeach
            @else
                <tr><td colspan="6" class="no-data">Aucune donnée existante.</td></tr>
            @endif
        </tbody>
    </table>

    {{-- 1.3 Nombre de classes par filière --}}
    <p class="section-title">1.3. Nombre de classes par filière</p>
    <table border="1" cellspacing="0">
        <thead>
            <tr>
                <th style="width:4%">N°</th>
                <th>Dénomination</th>
                <th>Groupe pédagogique</th>
                <th>Effectif total</th>
                <th>Garçons</th>
                <th>Filles</th>
            </tr>
        </thead>
        <tbody>
            @if($nbre_classes > 0)
                @foreach($classes as $classe)
                <tr style="text-align:center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $classe->denominationclasse ?? '' }}</td>
                    <td>{{ $classe->libellegp ?? '' }}</td>
                    <td>{{ $classe->effectif_total ?? '' }}</td>
                    <td>{{ $classe->effectif_gar ?? '' }}</td>
                    <td>{{ $classe->effectif_fil ?? '' }}</td>
                </tr>
                @endforeach
            @else
                <tr><td colspan="6" class="no-data">Aucune donnée existante.</td></tr>
            @endif
        </tbody>
    </table>

</div>

{{-- ================================================================
     PAGE 4 — EFFECTIFS DU PERSONNEL
     ================================================================ --}}
<div class="page">
    <h2>2 - LES EFFECTIFS DU PERSONNEL</h2>

    {{-- Personnels enseignants par discipline et grade --}}
    <p class="section-title">Personnels enseignants</p>
    <table border="1" cellspacing="0">
        <thead>
            <tr>
                <th rowspan="2" style="width:4%">N°</th>
                <th rowspan="2">Discipline</th>
                <th colspan="4">Existants et Grades</th>
                <th rowspan="2">TOTAL</th>
                <th rowspan="2">Nécessaire</th>
                <th rowspan="2">Ecarts</th>
                <th rowspan="2">Observations</th>
            </tr>
            <tr>
                <th>PETP</th>
                <th>PLP</th>
                <th>PCFP</th>
                <th>IFPB</th>
            </tr>
        </thead>
        <tbody>
            @if($personnels_enseignants_par_discipline->count() > 0)
                @foreach($personnels_enseignants_par_discipline as $pe)
                <tr style="text-align:center">
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-align:left">{{ $pe->libellediscipline ?? '' }}</td>
                    <td>{{ $pe->nb_petp }}</td>
                    <td>{{ $pe->nb_plp }}</td>
                    <td>{{ $pe->nb_pcfp }}</td>
                    <td>{{ $pe->nb_ifpb }}</td>
                    <td>{{ $pe->nb_total }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
            @else
                <tr><td colspan="10" class="no-data">Aucune donnée existante.</td></tr>
            @endif
        </tbody>
    </table>

    {{-- Personnels administratifs par fonction --}}
    <p class="section-title">Personnels Administratifs, d'encadrement et autres</p>
    <table border="1" cellspacing="0">
        <thead>
            <tr>
                <th style="width:4%">N°</th>
                <th>Fonctions</th>
                <th>Existants</th>
                <th>Nécessaire</th>
                <th>Ecarts</th>
                <th>Observations</th>
            </tr>
        </thead>
        <tbody>
            @if($personnels_admins_par_fonction->count() > 0)
                @foreach($personnels_admins_par_fonction as $pa)
                <tr style="text-align:center">
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-align:left">{{ $pa->libellefonction ?? '' }}</td>
                    <td>{{ $pa->nb_existants }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
            @else
                <tr><td colspan="6" class="no-data">Aucune donnée existante.</td></tr>
            @endif
        </tbody>
    </table>

    {{-- Besoins en personnels enseignants --}}
    <p class="section-title">Besoins en personnels enseignants</p>
    <table border="1" cellspacing="0">
        <thead>
            <tr>
                <th style="width:4%">N°</th>
                <th>Discipline</th>
                <th>Nombre</th>
                <th>Niveau de Qualification</th>
                <th>Observations</th>
            </tr>
        </thead>
        <tbody>
            @if($nbre_besoinpersonnelens > 0)
                @foreach($besoinpersonnelens as $bp)
                <tr style="text-align:center">
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-align:left">{{ $bp->libellediscipline ?? 'Non renseigné' }}</td>
                    <td>{{ $bp->nombre ?? '' }}</td>
                    <td>{{ $bp->libelleniveau ?? '' }}</td>
                    <td></td>
                </tr>
                @endforeach
            @else
                <tr><td colspan="5" class="no-data">Aucune donnée existante.</td></tr>
            @endif
        </tbody>
    </table>

    {{-- Besoins en personnels administratifs --}}
    <p class="section-title">Besoins en personnels administratifs, d'encadrement et autres</p>
    <table border="1" cellspacing="0">
        <thead>
            <tr>
                <th style="width:4%">N°</th>
                <th>Fonction</th>
                <th>Nombre</th>
                <th>Niveau de Qualification</th>
                <th>Observations</th>
            </tr>
        </thead>
        <tbody>
            @if($nbre_besoinpersonnel_admins > 0)
                @foreach($besoinpersonnel_admins as $ba)
                <tr style="text-align:center">
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-align:left">{{ $ba->libellefonction ?? 'Non renseigné' }}</td>
                    <td>{{ $ba->nombre ?? '' }}</td>
                    <td>{{ $ba->libelletypepersonnel ?? '' }}</td>
                    <td></td>
                </tr>
                @endforeach
            @else
                <tr><td colspan="5" class="no-data">Aucune donnée existante.</td></tr>
            @endif
        </tbody>
    </table>

</div>

{{-- ================================================================
     PAGE 5 — EFFECTIFS ET SITUATION DES APPRENANTS
     ================================================================ --}}
<div class="page">
    <h2>3 - EFFECTIFS ET SITUATION DES APPRENANTS</h2>

    <table border="1" cellspacing="0" style="font-size:10px;">
        <thead>
            <tr>
                <th rowspan="3" style="width:4%">N°</th>
                <th rowspan="3">Niveau / Filière</th>
                <th colspan="3" rowspan="2">Effectifs</th>
                <th colspan="6">Bourses</th>
                <th colspan="4">Régime</th>
            </tr>
            <tr>
                <th colspan="2">BE</th>
                <th colspan="2">½ B</th>
                <th colspan="2">NB</th>
                <th colspan="2">Interne</th>
                <th colspan="2">Externe</th>
            </tr>
            <tr>
                <th>F</th><th>G</th><th>T</th>
                <th>F</th><th>G</th>
                <th>F</th><th>G</th>
                <th>F</th><th>G</th>
                <th>F</th><th>G</th>
                <th>F</th><th>G</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_f=0; $total_g=0; $total_t=0;
                $tbe_f=0; $tbe_g=0; $tdemi_f=0; $tdemi_g=0; $tnb_f=0; $tnb_g=0;
                $tint_f=0; $tint_g=0; $text_f=0; $text_g=0;
            @endphp
            @if($boursiers->count() > 0)
                @foreach($boursiers as $b)
                @php
                    $f = $b->effectif_fil ?? 0; $g = $b->effectif_gar ?? 0; $t = $b->effectif_total ?? 0;
                    $total_f+=$f; $total_g+=$g; $total_t+=$t;
                    $tbe_f+=$b->be_f; $tbe_g+=$b->be_g;
                    $tdemi_f+=$b->demi_b_f; $tdemi_g+=$b->demi_b_g;
                    $tnb_f+=$b->nb_f; $tnb_g+=$b->nb_g;
                    $tint_f+=$b->interne_f; $tint_g+=$b->interne_g;
                    $text_f+=$b->externe_f; $text_g+=$b->externe_g;
                @endphp
                <tr style="text-align:center">
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-align:left">{{ $b->denominationclasse ?? '' }} — {{ $b->libellegp ?? '' }}</td>
                    <td>{{ $f }}</td><td>{{ $g }}</td><td>{{ $t }}</td>
                    <td>{{ $b->be_f }}</td><td>{{ $b->be_g }}</td>
                    <td>{{ $b->demi_b_f }}</td><td>{{ $b->demi_b_g }}</td>
                    <td>{{ $b->nb_f }}</td><td>{{ $b->nb_g }}</td>
                    <td>{{ $b->interne_f }}</td><td>{{ $b->interne_g }}</td>
                    <td>{{ $b->externe_f }}</td><td>{{ $b->externe_g }}</td>
                </tr>
                @endforeach
                <tr style="text-align:center; font-weight:bold; background:#dde;">
                    <td colspan="2">TOTAL</td>
                    <td>{{ $total_f }}</td><td>{{ $total_g }}</td><td>{{ $total_t }}</td>
                    <td>{{ $tbe_f }}</td><td>{{ $tbe_g }}</td>
                    <td>{{ $tdemi_f }}</td><td>{{ $tdemi_g }}</td>
                    <td>{{ $tnb_f }}</td><td>{{ $tnb_g }}</td>
                    <td>{{ $tint_f }}</td><td>{{ $tint_g }}</td>
                    <td>{{ $text_f }}</td><td>{{ $text_g }}</td>
                </tr>
            @else
                <tr><td colspan="15" class="no-data">Aucune donnée existante.</td></tr>
            @endif
        </tbody>
    </table>
</div>

{{-- ================================================================
     PAGE 6 — RESULTATS SCOLAIRES
     ================================================================ --}}
<div class="page">
    <h2>4 - RESULTATS SCOLAIRES</h2>

    {{-- Résultats de fin d'année --}}
    <p class="section-title">Résultats de fin d'année de formation</p>
    <table border="1" cellspacing="0" style="font-size:10px;">
        <thead>
            <tr>
                <th rowspan="2" style="width:4%">N°</th>
                <th rowspan="2">Filières</th>
                <th rowspan="2">Niveau</th>
                <th colspan="3">Effectifs</th>
                <th colspan="3">Admis</th>
                <th colspan="3">Redoublants</th>
                <th colspan="3">Réorientés</th>
                <th rowspan="2">Observations</th>
            </tr>
            <tr>
                <th>F</th><th>G</th><th>T</th>
                <th>F</th><th>G</th><th>T</th>
                <th>F</th><th>G</th><th>T</th>
                <th>F</th><th>G</th><th>T</th>
            </tr>
        </thead>
        <tbody>
            @if($nbre_resultats_fin_annee > 0)
                @foreach($resultats_fin_annee as $r)
                <tr style="text-align:center">
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-align:left">{{ $r->libellefiliere ?? '' }}</td>
                    <td>{{ $r->niveau ?? '' }}</td>
                    <td>{{ $r->effectif_f }}</td><td>{{ $r->effectif_g }}</td><td>{{ $r->effectif_t }}</td>
                    <td>{{ $r->admis_f }}</td><td>{{ $r->admis_g }}</td><td>{{ $r->admis_t }}</td>
                    <td>{{ $r->redoublants_f }}</td><td>{{ $r->redoublants_g }}</td><td>{{ $r->redoublants_t }}</td>
                    <td>{{ $r->reorientes_f }}</td><td>{{ $r->reorientes_g }}</td><td>{{ $r->reorientes_t }}</td>
                    <td></td>
                </tr>
                @endforeach
            @else
                <tr><td colspan="16" class="no-data">Aucune donnée existante.</td></tr>
            @endif
        </tbody>
    </table>

    {{-- Résultats aux examens scolaires --}}
    <p class="section-title">Résultats aux examens scolaires</p>
    <table border="1" cellspacing="0" style="font-size:10px;">
        <thead>
            <tr>
                <th rowspan="2" style="width:4%">N°</th>
                <th rowspan="2">Examens</th>
                <th rowspan="2">Filières</th>
                <th colspan="3">Nombre de Candidats</th>
                <th colspan="3">Nombre d'admis</th>
                <th rowspan="2">% Admis</th>
                <th rowspan="2">Observations</th>
            </tr>
            <tr>
                <th>F</th><th>G</th><th>T</th>
                <th>F</th><th>G</th><th>T</th>
            </tr>
        </thead>
        <tbody>
            @if($nbre_resultatexamens > 0)
                @foreach($resultatexamens as $re)
                @php
                    $pct = $re->nombrecandidat_t > 0
                        ? round(($re->nombreadmis_t / $re->nombrecandidat_t) * 100, 1) . ' %'
                        : '—';
                @endphp
                <tr style="text-align:center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $re->libellediplome ?? '' }}</td>
                    <td style="text-align:left">{{ $re->libellefiliere ?? '' }}</td>
                    <td>{{ $re->nombrecandidat_f ?? '' }}</td>
                    <td>{{ $re->nombrecandidat_g ?? '' }}</td>
                    <td>{{ $re->nombrecandidat_t ?? '' }}</td>
                    <td>{{ $re->nombreadmis_f ?? '' }}</td>
                    <td>{{ $re->nombreadmis_g ?? '' }}</td>
                    <td>{{ $re->nombreadmis_t ?? '' }}</td>
                    <td>{{ $pct }}</td>
                    <td></td>
                </tr>
                @endforeach
            @else
                <tr><td colspan="11" class="no-data">Aucune donnée existante.</td></tr>
            @endif
        </tbody>
    </table>

    {{-- Indicateurs de performance --}}
    <p class="section-title">Indicateurs de performance</p>
    <table border="1" cellspacing="0">
        <thead>
            <tr>
                <th style="width:4%">N</th>
                <th>INDICATEURS-CLES DE PERFORMANCE</th>
                <th>TAUX OBTENUS {{ date('Y') }}-{{ date('Y')+1 }}</th>
                <th>OBSERVATIONS</th>
            </tr>
        </thead>
        <tbody>
            @php
            $indicateurs_defaut = [
                '01' => "Le taux de réussite à l'examen du CAP",
                '02' => "Le taux de réussite à l'examen du BT",
                '03' => "Le taux de réussite à l'examen du BTS",
                '04' => "Le taux d'obtention du diplôme en % des admissions initiales",
                '05' => "Le taux de décrochage",
                '06' => "Le taux de satisfaction des apprenants",
                '07' => "Le taux de satisfaction des Entreprises",
                '08' => "Le taux de présence ou de participation des apprenants au cours",
                '09' => "Le taux de présence des formateurs au cours",
                '10' => "Le taux d'apprenants de 1A mis en stage",
                '11' => "Le taux d'apprenants de 2A mis en stage",
                '12' => "Le taux d'apprenants de 3A mis en stage",
                '13' => "Taux d'apprenants admis en classe supérieure",
                '14' => "Taux d'apprenants admis à redoubler",
                '15' => "Taux d'apprenants réorientés",
                '16' => "Le taux d'apprenants diplômés insérés 12 mois après la fin du cycle",
            ];
            @endphp
            @foreach($indicateurs_defaut as $num => $libelle)
            <tr>
                <td style="text-align:center">{{ $num }}</td>
                <td>{{ $libelle }}</td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- ================================================================
     PAGE 7 — INFRASTRUCTURES + EQUIPEMENTS + BESOINS MATERIELS
     ================================================================ --}}
<div class="page">
    <h2>5 - ETAT DES INFRASTRUCTURES</h2>

    <p class="section-title">Nombre de bâtiments</p>
    <table border="1" cellspacing="0">
        <thead>
            <tr>
                <th style="width:4%">N°</th>
                <th>Libellé</th>
                <th>Nombre</th>
                <th>Capacité</th>
                <th>Fonctionnels</th>
                <th>Non fonctionnels</th>
                <th>Observation</th>
            </tr>
        </thead>
        <tbody>
            @if($nbre_infrastructures > 0)
                @foreach($infrastructures as $infra)
                <tr style="text-align:center">
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-align:left">{{ $infra->libelleinfrastructure ?? '' }}</td>
                    <td>{{ $infra->nombre ?? '' }}</td>
                    <td>{{ $infra->cap ?? '' }}</td>
                    <td>{{ $infra->nbrefonctionnel ?? '' }}</td>
                    <td>{{ $infra->nbrenonfonctionel ?? '' }}</td>
                    <td>{{ $infra->obs ?? '' }}</td>
                </tr>
                @endforeach
            @else
                <tr><td colspan="7" class="no-data">Aucune donnée existante.</td></tr>
            @endif
        </tbody>
    </table>

    <h2>6 - BESOINS EN MATERIELS ET EQUIPEMENTS</h2>

    <p class="section-title">Besoins en matériels</p>
    <table border="1" cellspacing="0">
        <thead>
            <tr>
                <th style="width:4%">N°</th>
                <th>Désignation</th>
                <th>Quantité</th>
                <th>Observations</th>
            </tr>
        </thead>
        <tbody>
            @if($nbre_besoinsenmateriels > 0)
                @foreach($besoinsenmateriels as $bm)
                <tr style="text-align:center">
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-align:left">{{ $bm->libellemateriel ?? 'Non renseigné' }}</td>
                    <td>{{ $bm->quantite ?? '' }}</td>
                    <td></td>
                </tr>
                @endforeach
            @else
                <tr><td colspan="4" class="no-data">Aucune donnée existante.</td></tr>
            @endif
        </tbody>
    </table>

    <p class="section-title">Equipements existants</p>
    <table border="1" cellspacing="0">
        <thead>
            <tr>
                <th style="width:4%">N°</th>
                <th>Matériel</th>
                <th>Nombre</th>
                <th>Fonctionnels</th>
                <th>Non fonctionnels</th>
            </tr>
        </thead>
        <tbody>
            @if($nbre_equipements > 0)
                @foreach($equipements as $eq)
                <tr style="text-align:center">
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-align:left">{{ $eq->libellemateriel ?? 'Non renseigné' }}</td>
                    <td>{{ $eq->nombre ?? '' }}</td>
                    <td>{{ $eq->nbrefonctionnel ?? '' }}</td>
                    <td>{{ $eq->nbrenonfonctionel ?? '' }}</td>
                </tr>
                @endforeach
            @else
                <tr><td colspan="5" class="no-data">Aucune donnée existante.</td></tr>
            @endif
        </tbody>
    </table>
</div>

{{-- ================================================================
     PAGE 8 — GESTION FINANCIERE + ACTIVITES + DIFFICULTES + PREVISIONS
     ================================================================ --}}
<div class="page">
    <h2>7 - GESTION FINANCIERE</h2>

    <p class="section-title">Informations sur le compte bancaire</p>
    <p>Etablissement financier : ___________________________________________</p>
    <p>Numéro du compte : ___________________________________________</p>

    <p class="section-title">Ressources additionnelles — Frais d'inscription et de scolarité</p>
    <table border="1" cellspacing="0">
        <thead>
            <tr>
                <th>Nature</th>
                <th>Nombre d'élèves</th>
                <th>Total perçus</th>
                <th>Part établissement</th>
                <th>Part versée au fonds école</th>
                <th>Observations</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Frais de scolarité</td>
                <td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr style="font-weight:bold">
                <td>TOTAL</td>
                <td></td><td></td><td></td><td></td><td></td>
            </tr>
        </tbody>
    </table>

    <h2>8 - ACTIVITES EXTRA-SCOLAIRES</h2>
    <table border="1" cellspacing="0">
        <thead>
            <tr>
                <th style="width:4%">N°</th>
                <th>Nature</th>
                <th>Objectifs</th>
                <th>Observations</th>
            </tr>
        </thead>
        <tbody>
            @if($nbre_activites_extra > 0)
                @foreach($activites_extra as $act)
                <tr>
                    <td style="text-align:center">{{ $loop->iteration }}</td>
                    <td>{{ $act->nature ?? '' }}</td>
                    <td>{{ $act->objectifs ?? '' }}</td>
                    <td>{{ $act->observations ?? '' }}</td>
                </tr>
                @endforeach
            @else
                <tr><td colspan="4" class="no-data">Aucune donnée existante.</td></tr>
            @endif
        </tbody>
    </table>

    <h2>9 - DIFFICULTES RENCONTREES ET SUGGESTIONS</h2>
    <table border="1" cellspacing="0">
        <thead>
            <tr>
                <th style="width:4%">N°</th>
                <th>Nature</th>
                <th>Difficultés</th>
                <th>Causes</th>
                <th>Propositions et Suggestions</th>
                <th>Observations</th>
            </tr>
        </thead>
        <tbody>
            @if($nbre_etatgestions > 0)
                @foreach($etatgestions as $eg)
                <tr>
                    <td style="text-align:center">{{ $loop->iteration }}</td>
                    <td>{{ $eg->nature ?? '' }}</td>
                    <td>{{ $eg->difficultes ?? '' }}</td>
                    <td>{{ $eg->causes ?? '' }}</td>
                    <td>{{ $eg->suggestions ?? '' }}</td>
                    <td>{{ $eg->observations ?? '' }}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td style="text-align:center">1</td>
                    <td>PEDAGOGIQUE</td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                    <td style="text-align:center">2</td>
                    <td>ADMINISTRATIVE</td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                    <td style="text-align:center">3</td>
                    <td>AUTRES</td><td></td><td></td><td></td><td></td>
                </tr>
            @endif
        </tbody>
    </table>

    <h2>10 - PREVISIONS / PERSPECTIVES POUR L'ANNEE SUIVANTE</h2>
    <table border="1" cellspacing="0">
        <thead>
            <tr>
                <th style="width:4%">N°</th>
                <th>Nature</th>
                <th>Objectif</th>
                <th>Observations</th>
            </tr>
        </thead>
        <tbody>
            @if($nbre_previsions > 0)
                @foreach($previsions as $prev)
                <tr>
                    <td style="text-align:center">{{ $loop->iteration }}</td>
                    <td>{{ $prev->libelleprevision ?? '' }}</td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
            @else
                @for($i = 1; $i <= 5; $i++)
                <tr><td style="text-align:center">{{ $i }}</td><td></td><td></td><td></td></tr>
                @endfor
            @endif
        </tbody>
    </table>

    <h2>CONCLUSION GENERALE</h2>
    @if($nbre_conclusions > 0)
        @foreach($conclusions as $concl)
        <p>{{ $concl->libelleconclusion ?? '' }}</p>
        @endforeach
    @else
        <p>______________________________________________________________</p>
        <p>______________________________________________________________</p>
    @endif
</div>

{{-- ================================================================
     ANNEXES — Résultats scolaires par classe (liste nominative)
     ================================================================ --}}
<div class="page-break">
    <h2>ANNEXES DU RAPPORT DE FIN D'ANNEE</h2>
    <p><em>Résultats Scolaires par classe</em></p>
</div>

@if($nbre_apprenants > 0)
    @foreach($apprenants as $classe => $eleves)
    <div class="{{ !$loop->last ? 'page' : '' }}">
        <p><strong>Classe : {{ $classe }}</strong>
           &nbsp;&nbsp; Effectif : {{ $eleves->count() }}</p>
        <table border="1" cellspacing="0" style="font-size:10px;">
            <thead>
                <tr>
                    <th style="width:4%">N°</th>
                    <th>Nom</th>
                    <th>Prénoms</th>
                    <th>Moyenne annuelle</th>
                    <th>Rang</th>
                    <th>Etat de Bourse</th>
                    <th>Décision de fin d'année</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eleves as $index => $apprenant)
                <tr style="text-align:center">
                    <td>{{ $index + 1 }}</td>
                    <td style="text-align:left">{{ $apprenant->nom ?? '' }}</td>
                    <td style="text-align:left">{{ $apprenant->prenoms ?? '' }}</td>
                    <td>{{ $apprenant->moyenneannee ?? '' }}</td>
                    <td></td>
                    <td>{{ $apprenant->libellebourse ?? '' }}</td>
                    <td>{{ $apprenant->libelledecision ?? '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p style="font-size:10px;"><strong>NB :</strong>
            Décision de fin d'année = <strong>Admis</strong> ou <strong>Report</strong>
            ou <strong>Redoublant</strong> ou <strong>Réorienté</strong><br>
            Etat de bourse = Boursier ou ½ Boursier ou Non boursier
        </p>
    </div>
    @endforeach
@else
    <p class="no-data">Aucun apprenant enregistré.</p>
@endif

</body>
</html>
