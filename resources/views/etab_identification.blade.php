<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Rapport de Rentrée</title>
    <style type="text/css">
        body { font-family: Helvetica, Arial, sans-serif; font-size: 13px; }

        th {
            background-color: #0856ba;
            text-align: center;
            font-size: 11px !important;
            color: #fff;
            padding: 5px 3px;
        }
        td {
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
            font-size: 11px !important;
            padding: 4px 3px;
        }
        table { border-collapse: collapse; width: 100%; }

        .page-break { page-break-before: always; }
        .no-break    { page-break-inside: avoid; }

        /* Emplois du temps */
        .edt-header {
            background-color: #000;
            color: #fff;
            padding: 5px;
            text-align: center;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 1px solid #000;
        }
        .edt-table { width: 100%; border-collapse: collapse; font-size: 8px; }
        .edt-table th {
            background-color: #000; color: #fff; padding: 2px;
            text-align: center; border: 1px solid #000; font-size: 8px; height: 20px;
        }
        .edt-table td { padding: 2px; border: 1px solid #000; vertical-align: middle; text-align: center; height: 25px; }
        .edt-heure  { background-color: #f0f0f0; font-weight: bold; font-size: 8px; }
        .edt-pause  { background-color: #f0f0f0; font-weight: bold; font-style: italic; font-size: 8px; }

        /* Sections */
        h3.section { font-size: 13px; font-weight: bold; margin-top: 14px; }
        p.label     { font-weight: bold; margin: 8px 0 4px 0; }
        .ras        { color: #ed7d31; font-weight: bold; font-style: italic; text-align: center; }
        .empty-cell { color: #ed7d31; font-weight: bold; font-style: italic; text-align: center; }
    </style>
</head>
<body>

{{-- ══════════════════════════════════════════════════════════════════════
     PAGE DE COUVERTURE
══════════════════════════════════════════════════════════════════════ --}}
<div style="width:100%; text-align:center;">
    <img src="https://formation-professionnelle.gouv.ci/wp-content/uploads/2023/06/LOGO-SITE-02-1.png" height="140">
</div>
<br>
<div style="text-align:center; font-weight:bold;">
    <h2 style="font-size:34px;">DIRECTION GÉNÉRALE DE LA FORMATION INITIALE</h2>
    <p style="margin-top:-20px;">----------------------</p>
    <h2 style="font-size:34px; color:#174e84ff; margin-top:-10px;">DIRECTION DES ÉTABLISSEMENTS PUBLICS</h2>
</div>
<br>
<div style="page-break-after:always; text-align:center;">
    <h2 style="font-weight:bold;">ÉTABLISSEMENT : {{ $etablissements->denominationetab ?? '' }}</h2>
    <h1 style="font-size:70px; font-weight:bold;">RAPPORT DE<br>RENTRÉE</h1>
    <h3 style="font-size:26px; font-weight:bold;">ANNÉE DE FORMATION : {{ $etablissements->libelleanneescolaire ?? '202..-202..' }}</h3>
</div>

{{-- ══════════════════════════════════════════════════════════════════════
     SOMMAIRE
══════════════════════════════════════════════════════════════════════ --}}
<div style="page-break-after:always;">
    <h3 style="text-align:center; font-size:18px;">SOMMAIRE</h3>
    <p style="font-weight:bold;">1. PRÉSENTATION DE L'ÉTABLISSEMENT ET DES FILIÈRES DE FORMATION</p>
    <p>&nbsp;&nbsp;&nbsp;1.1. Présentation de l'établissement</p>
    <p>&nbsp;&nbsp;&nbsp;1.2. Filières de formation</p>
    <p>&nbsp;&nbsp;&nbsp;1.3. Nombre de classes par filière</p><br>
    <p style="font-weight:bold;">2. ÉQUIPE DE DIRECTION ET AUTRES PERSONNELS ADMINISTRATIFS</p>
    <p>&nbsp;&nbsp;&nbsp;2.1. Équipe de direction</p>
    <p>&nbsp;&nbsp;&nbsp;2.2. Autres personnels administratifs</p>
    <p>&nbsp;&nbsp;&nbsp;2.3. Besoins en personnels administratifs et autres</p><br>
    <p style="font-weight:bold;">3. PERSONNEL ENSEIGNANT</p>
    <p>&nbsp;&nbsp;&nbsp;3.1. Effectif du personnel enseignant</p>
    <p>&nbsp;&nbsp;&nbsp;3.2. Conseils d'enseignement</p>
    <p>&nbsp;&nbsp;&nbsp;3.3. Besoins en personnel enseignant</p><br>
    <p style="font-weight:bold;">4. APPRENANTS</p>
    <p>&nbsp;&nbsp;&nbsp;4.1. Effectif des Apprenants par niveau et par classe</p>
    <p>&nbsp;&nbsp;&nbsp;4.2. Effectifs des Apprenants de 1ère année et de seconde en fonction du mode de recrutement</p>
    <p>&nbsp;&nbsp;&nbsp;4.3. Statut des Apprenants par filière et par niveau</p>
    <p>&nbsp;&nbsp;&nbsp;4.4. Récapitulatif général</p>
    <p>&nbsp;&nbsp;&nbsp;4.5. Cours du soir</p><br>
    <p style="font-weight:bold;">5. BILAN DES MISES EN STAGE DE VACANCES</p>
    <p>&nbsp;&nbsp;&nbsp;5.1. Taux de mise en stage</p>
    <p>&nbsp;&nbsp;&nbsp;5.2. Analyse de la situation</p><br>
    <p style="font-weight:bold;">6. POINT DE L'EXÉCUTION DES PROGRAMMES ET PROGRESSIONS</p><br>
    <p style="font-weight:bold;">7. INDICATEURS DE PERFORMANCE</p><br>
    <p style="font-weight:bold;">8. INFRASTRUCTURES ET LOCAUX</p>
    <p>&nbsp;&nbsp;&nbsp;8.1. Bâtiments</p>
    <p>&nbsp;&nbsp;&nbsp;8.2. Clôture</p>
    <p>&nbsp;&nbsp;&nbsp;8.3. Problèmes liés aux infrastructures</p><br>
    <p style="font-weight:bold;">9. INVENTAIRE GÉNÉRAL DU MATÉRIEL ET DES ÉQUIPEMENTS</p>
    <p>&nbsp;&nbsp;&nbsp;9.1. Matériels</p>
    <p>&nbsp;&nbsp;&nbsp;9.2. Équipements</p><br>
    <p style="font-weight:bold;">10. GESTION FINANCIÈRE</p>
    <p>&nbsp;&nbsp;&nbsp;10.1. État du budget</p>
    <p>&nbsp;&nbsp;&nbsp;10.2. Ressources additionnelles</p>
    <p>&nbsp;&nbsp;&nbsp;10.3. Frais d'inscription et de scolarité</p>
    <p>&nbsp;&nbsp;&nbsp;10.4. Autres ressources (productions et travaux extérieurs)</p><br>
    <p style="font-weight:bold;">11. COMITÉ DE GESTION</p><br>
    <p style="font-weight:bold;">12. ACTIVITÉS SOCIO-ÉDUCATIVES</p>
    <p>&nbsp;&nbsp;&nbsp;12.1. Activités sportives</p>
    <p>&nbsp;&nbsp;&nbsp;12.2. Clubs et associations</p><br>
    <p style="font-weight:bold;">13. PROBLÈMES URGENTS</p><br>
    <p style="font-weight:bold;">14. PERSPECTIVES</p><br>
    <p style="font-weight:bold;">CONCLUSION</p><br>
    <p style="font-weight:bold;">ANNEXES</p>
    <ul>
        <li>Listes des personnels (administratif, enseignant et autres)</li>
        <li>Listes des stagiaires et étudiants par classe</li>
        <li>Emplois du temps classe</li>
        <li>Emplois du temps professeurs</li>
        <li>Liste des Enseignants ayant des heures supplémentaires</li>
    </ul>
</div>

{{-- ══════════════════════════════════════════════════════════════════════
     1. PRÉSENTATION DE L'ÉTABLISSEMENT
══════════════════════════════════════════════════════════════════════ --}}
<div style="page-break-after:always;">
    <p style="font-weight:bold; font-size:14px;">1. PRÉSENTATION DE L'ÉTABLISSEMENT ET DES FILIÈRES DE FORMATION</p>
    <h3 class="section">1.1. Présentation de l'établissement</h3>
    <ul>
        <li><strong>Direction Régionale :</strong> {{ $etablissements->denominationdd ?? 'Non renseigné' }}</li>
        <li><strong>Établissement :</strong> {{ $etablissements->denominationetab ?? 'Non renseigné' }}</li>
        <li><strong>Code :</strong> {{ $etablissements->code ?? 'Non renseigné' }}</li>
        <li><strong>Date de création de l'établissement :</strong> ……………………………………</li>
        <li><strong>Date d'ouverture de l'établissement :</strong> ……………………………………</li>
        <li><strong>Situation géographique :</strong> {{ $etablissements->localisation ?? '……………………………………' }}</li>
        <li><strong>Adresse Postale :</strong> …………………………&nbsp;&nbsp;
            <strong>Téléphone :</strong> Fixe : {{ $etablissements->contact ?? '……………………' }}&nbsp;&nbsp;
            Mobile : ……………………</li>
        <li><strong>Fax :</strong> ………………………&nbsp;&nbsp;<strong>Email :</strong> …………………………………</li>
    </ul>

    <h3 class="section">1.2. Les filières de formation</h3>
    @if($nbre_filiere_enseignes > 0)
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th style="width:4%">N°</th>
                    <th>Filière / Série</th>
                    <th>Code</th>
                    <th>Diplômes préparés</th>
                    <th>Durée des études</th>
                    <th>Observations</th>
                </tr>
            </thead>
            <tbody>
                @foreach($filiere_enseignes as $fe)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fe->libellefiliere ?? '' }}</td>
                    <td>{{ $fe->filnumaut ?? '' }}</td>
                    <td>{{ $fe->libellediplome ?? '' }}</td>
                    <td>{{ $fe->dureeformation ?? '' }}</td>
                    <td>{{ $fe->observation ?? '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="ras">Aucune filière enregistrée.</p>
    @endif

    <h3 class="section">1.3. Nombre de classes par filière</h3>

    @if($etablissements->ordre_enseignement_id == 1)
        {{-- Enseignement technique --}}
        <p class="label">Enseignement technique</p>
        <table border="1" cellpadding="3" cellspacing="0">
            <thead>
                <tr>
                    <th>Diplômes</th><th>Filières/Série</th><th>Code</th>
                    <th>Seconde</th><th>Première</th><th>Terminale</th><th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classefilieres as $cf)
                <tr>
                    <td>{{ $cf->libellediplome ?? '' }}</td>
                    <td>{{ $cf->libellefiliere ?? '' }}</td>
                    <td>{{ $cf->code ?? '' }}</td>
                    <td>{{ $cf->seconde ?? '' }}</td>
                    <td>{{ $cf->premiere ?? '' }}</td>
                    <td>{{ $cf->terminale ?? '' }}</td>
                    <td>{{ ($cf->seconde ?? 0) + ($cf->premiere ?? 0) + ($cf->terminale ?? 0) }}</td>
                </tr>
                @empty
                <tr><td colspan="7" class="empty-cell">Aucune donnée.</td></tr>
                @endforelse
            </tbody>
        </table>
    @endif

    @if($etablissements->ordre_enseignement_id == 2)
        {{-- Formation professionnelle --}}
        <p class="label">Formation professionnelle</p>
        <table border="1" cellpadding="3" cellspacing="0">
            <thead>
                <tr>
                    <th>Diplômes</th><th>Filières</th><th>Code</th>
                    <th>1ère année</th><th>2ème année</th><th>3ème année</th><th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classefilieres as $cf)
                <tr>
                    <td>{{ $cf->libellediplome ?? '' }}</td>
                    <td>{{ $cf->libellefiliere ?? '' }}</td>
                    <td>{{ $cf->code ?? '' }}</td>
                    <td>{{ $cf->premiere_annee ?? '' }}</td>
                    <td>{{ $cf->deuxieme_annee ?? '' }}</td>
                    <td>{{ $cf->troisieme_annee ?? '' }}</td>
                    <td>{{ ($cf->premiere_annee ?? 0) + ($cf->deuxieme_annee ?? 0) + ($cf->troisieme_annee ?? 0) }}</td>
                </tr>
                @empty
                <tr><td colspan="7" class="empty-cell">Aucune donnée.</td></tr>
                @endforelse
            </tbody>
        </table>
    @endif

    @if($etablissements->ordre_enseignement_id == 4)
        <p class="label">Enseignement professionnel</p>
        <table border="1" cellpadding="3" cellspacing="0">
            <thead>
                <tr>
                    <th>Diplômes</th><th>Filières</th><th>Code</th>
                    <th>1ère année</th><th>2ème année</th><th>3ème année</th><th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classefilierepros as $cf)
                <tr>
                    <td>{{ $cf->libellediplome ?? '' }}</td>
                    <td>{{ $cf->libellefiliere ?? '' }}</td>
                    <td>{{ $cf->code ?? '' }}</td>
                    <td>{{ $cf->premiere_annee ?? '' }}</td>
                    <td>{{ $cf->deuxieme_annee ?? '' }}</td>
                    <td>{{ $cf->troisieme_annee ?? '' }}</td>
                    <td>{{ ($cf->premiere_annee ?? 0) + ($cf->deuxieme_annee ?? 0) + ($cf->troisieme_annee ?? 0) }}</td>
                </tr>
                @empty
                <tr><td colspan="7" class="empty-cell">Aucune donnée.</td></tr>
                @endforelse
            </tbody>
        </table>
        <br>
        <p class="label">Enseignement technique</p>
        <table border="1" cellpadding="3" cellspacing="0">
            <thead>
                <tr>
                    <th>Diplômes</th><th>Filières</th><th>Code</th>
                    <th>Seconde</th><th>Première</th><th>Terminale</th><th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classefilieretechs as $cf)
                <tr>
                    <td>{{ $cf->libellediplome ?? '' }}</td>
                    <td>{{ $cf->libellefiliere ?? '' }}</td>
                    <td>{{ $cf->code ?? '' }}</td>
                    <td>{{ $cf->seconde ?? '' }}</td>
                    <td>{{ $cf->premiere ?? '' }}</td>
                    <td>{{ $cf->terminale ?? '' }}</td>
                    <td>{{ ($cf->seconde ?? 0) + ($cf->premiere ?? 0) + ($cf->terminale ?? 0) }}</td>
                </tr>
                @empty
                <tr><td colspan="7" class="empty-cell">Aucune donnée.</td></tr>
                @endforelse
            </tbody>
        </table>
    @endif
</div>

{{-- ══════════════════════════════════════════════════════════════════════
     2. ÉQUIPE DE DIRECTION ET AUTRES PERSONNELS ADMINISTRATIFS
══════════════════════════════════════════════════════════════════════ --}}
<div style="page-break-after:always;">
    <p style="font-weight:bold; font-size:14px;">2. ÉQUIPE DE DIRECTION ET AUTRES PERSONNELS ADMINISTRATIFS</p>

    <h3 class="section">2.1. Équipe de direction</h3>
    <table border="1" cellpadding="3" cellspacing="0">
        <thead>
            <tr>
                <th>Fonctions</th>
                <th>Matricule</th>
                <th>Nom</th>
                <th>Prénoms</th>
                <th>Sexe</th>
                <th>Spécialité</th>
                <th>Emploi</th>
                <th>Ancienneté<br>Fonct. Pub.</th>
                <th>Ancienneté<br>Fonction</th>
                <th>Ancienneté<br>Établissement</th>
                <th>Date retraite</th>
            </tr>
        </thead>
        <tbody>
            @forelse($equipedirections as $ed)
            <tr>
                <td>{{ $ed->libellefonction ?? '' }}</td>
                <td>{{ $ed->matricule ?? '' }}</td>
                <td>{{ $ed->nom ?? '' }}</td>
                <td>{{ $ed->prenoms ?? '' }}</td>
                <td>{{ $ed->sexe ?? '' }}</td>
                <td>{{ $ed->libellediscipline ?? '' }}</td>
                <td>{{ $ed->emploi ?? '' }}</td>
                <td>{{ $ed->anciennete_fp ?? '' }}</td>
                <td>{{ $ed->anciennete_fonction ?? '' }}</td>
                <td>{{ $ed->anciennete_etab ?? '' }}</td>
                <td>{{ $ed->date_retraite ?? '' }}</td>
            </tr>
            @empty
            <tr><td colspan="11" class="empty-cell">Aucune donnée existante.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h3 class="section">2.2. Autres personnels administratifs</h3>
    <table border="1" cellpadding="3" cellspacing="0">
        <thead>
            <tr>
                <th rowspan="2">Fonctions</th>
                <th colspan="2">Nombre</th>
                <th rowspan="2">TOTAL</th>
                <th rowspan="2">Observations</th>
            </tr>
            <tr>
                <th>Hommes</th>
                <th>Femmes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($autrespersonnelsadmins as $pa)
            <tr>
                <td>{{ $pa->libellefonction ?? '' }}</td>
                <td>{{ $pa->HOMMES ?? '' }}</td>
                <td>{{ $pa->FEMMES ?? '' }}</td>
                <td>{{ ($pa->FEMMES ?? 0) + ($pa->HOMMES ?? 0) }}</td>
                <td></td>
            </tr>
            @empty
            <tr><td colspan="5" class="empty-cell">Aucune donnée existante.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- [NOUVEAU] Besoins en personnels administratifs --}}
    <h3 class="section">2.3. Besoins en personnels administratifs et autres</h3>
    <table border="1" cellpadding="3" cellspacing="0">
        <thead>
            <tr>
                <th>Fonction</th>
                <th>Nombre existant</th>
                <th>Nombre nécessaire</th>
                <th>Besoins</th>
                <th>Emploi</th>
                <th>Observations</th>
            </tr>
        </thead>
        <tbody>
            @forelse($besoinspersonneladmins as $ba)
            <tr>
                <td>{{ $ba->libellefonction ?? '' }}</td>
                <td>{{ $ba->nombre_existant ?? '' }}</td>
                <td>{{ $ba->nombre_necessaire ?? '' }}</td>
                <td>{{ $ba->nombre ?? '' }}</td>
                <td>{{ $ba->emploi ?? '' }}</td>
                <td>{{ $ba->observations ?? '' }}</td>
            </tr>
            @empty
            <tr><td colspan="6" class="empty-cell">Aucune donnée existante.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ══════════════════════════════════════════════════════════════════════
     3. PERSONNEL ENSEIGNANT
══════════════════════════════════════════════════════════════════════ --}}
<div style="page-break-after:always;">
    <p style="font-weight:bold; font-size:14px;">3. PERSONNEL ENSEIGNANT</p>

    <h3 class="section">3.1. Effectif du personnel enseignant par discipline</h3>
    <table border="1" cellpadding="3" cellspacing="0">
        <thead>
            <tr>
                <th>N°</th>
                <th>Discipline</th>
                <th>Hommes</th>
                <th>Femmes</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @forelse($effectifsenseignants as $ee)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $ee->libellediscipline ?? '' }}</td>
                <td>{{ $ee->HOMMES ?? '' }}</td>
                <td>{{ $ee->FEMMES ?? '' }}</td>
                <td>{{ ($ee->FEMMES ?? 0) + ($ee->HOMMES ?? 0) }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="empty-cell">Aucune donnée existante.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h3 class="section">3.2. Les Conseils d'Enseignement (CE)</h3>
    <table border="1" cellpadding="3" cellspacing="0">
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
            @php $conseilsFiltres = $personnels->filter(fn($p) => isset($p->cons_ens) && $p->cons_ens == 1); @endphp
            @if($conseilsFiltres->count() > 0)
                @foreach($conseilsFiltres as $i => $conseil)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $conseil->libellediscipline ?? 'aucune' }}</td>
                    <td>{{ $conseil->nom . ' ' . $conseil->prenoms }}</td>
                    <td>{{ $conseil->tel ?? '' }}</td>
                    <td>{{ $conseil->pemail ?? '' }}</td>
                </tr>
                @endforeach
            @else
                <tr><td colspan="5" class="empty-cell">Aucun Conseil d'Enseignement trouvé.</td></tr>
            @endif
        </tbody>
    </table>

    {{-- [NOUVEAU] Besoins en personnel enseignant (données réelles depuis besoinpersonnelens) --}}
    <h3 class="section">3.3. Besoins en personnel enseignant</h3>
    <table border="1" cellpadding="3" cellspacing="0">
        <thead>
            <tr>
                <th style="width:4%">N°</th>
                <th>Niveau de l'enseignant</th>
                <th>Discipline</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @forelse($besoinspersonnelens as $be)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $be->libelleniveauenseignant ?? '' }}</td>
                <td>{{ $be->libellediscipline ?? '' }}</td>
                <td>{{ $be->nombre ?? '' }}</td>
            </tr>
            @empty
            <tr>
                <td style="height:35px;"></td><td></td><td></td><td></td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ══════════════════════════════════════════════════════════════════════
     4. APPRENANTS
══════════════════════════════════════════════════════════════════════ --}}
<div style="page-break-after:always;">
    <p style="font-weight:bold; font-size:14px;">4. APPRENANTS</p>

    <h3 class="section">4.1. Effectif des apprenants par niveau et par classe</h3>
    @foreach($effectifsapprenantsParFilieres as $entete => $effGroup)
        <h4>{{ $entete }}</h4>
        <table border="1" cellpadding="3" cellspacing="0">
            <thead>
                <tr>
                    <th>Niveau</th><th>Filière</th><th>Classe</th>
                    <th>Boursiers</th><th>Non boursiers</th><th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($effGroup as $eff)
                <tr>
                    <td>{{ $eff->libelleniveau ?? '' }}</td>
                    <td>{{ $eff->libellefiliere ?? '' }}</td>
                    <td>{{ $eff->denominationclasse ?? '' }}</td>
                    <td>{{ $eff->boursier ?? '' }}</td>
                    <td>{{ $eff->non_boursier ?? '' }}</td>
                    <td>{{ ($eff->boursier ?? 0) + ($eff->non_boursier ?? 0) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
    @endforeach

    <h3 class="section">4.2. Effectif des apprenants de 1ère année et de seconde en fonction du mode de recrutement</h3>
    <table border="1" cellpadding="3" cellspacing="0">
        <thead>
            <tr>
                <th>Diplôme</th><th>Affectés</th><th>Non affectés</th><th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @forelse($effectifsrecrutements as $er)
            <tr>
                <td>{{ $er->libellediplome ?? '' }}</td>
                <td>{{ $er->affecte ?? '' }}</td>
                <td>{{ $er->non_affecte ?? '' }}</td>
                <td>{{ ($er->affecte ?? 0) + ($er->non_affecte ?? 0) }}</td>
            </tr>
            @empty
            <tr><td colspan="4" class="empty-cell">Aucune donnée existante.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h3 class="section">4.3. Statut des apprenants par filière et par niveau</h3>
    <table border="1" cellpadding="3" cellspacing="0">
        <thead>
            <tr>
                <th>Filière</th><th>Diplôme</th><th>Niveau</th>
                <th>F</th><th>G</th><th>T</th>
            </tr>
        </thead>
        <tbody>
            @forelse($statutsapprenants as $sa)
            <tr>
                <td>{{ $sa->libellefiliere ?? '' }}</td>
                <td>{{ $sa->libellediplome ?? '' }}</td>
                <td>{{ $sa->libelleniveau ?? '' }}</td>
                <td>{{ $sa->F ?? '' }}</td>
                <td>{{ $sa->M ?? '' }}</td>
                <td>{{ ($sa->F ?? 0) + ($sa->M ?? 0) }}</td>
            </tr>
            @empty
            <tr><td colspan="6" class="empty-cell">Aucune donnée existante.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h3 class="section">4.4. Récapitulatif général</h3>
    <table border="1" cellpadding="3" cellspacing="0">
        <thead>
            <tr>
                <th>Niveau</th><th>CAP</th>
                <th>Secondaire professionnel</th><th>Secondaire technique</th><th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recapGens as $rg)
            <tr>
                <td>{{ $rg->libelleniveau ?? '' }}</td>
                <td>{{ $rg->CAP ?? '' }}</td>
                <td>{{ ($rg->BEP ?? 0) + ($rg->BT ?? 0) }}</td>
                <td>{{ $rg->BAC ?? '' }}</td>
                <td>{{ ($rg->CAP ?? 0) + ($rg->BEP ?? 0) + ($rg->BT ?? 0) + ($rg->BAC ?? 0) }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="empty-cell">Aucune donnée existante.</td></tr>
            @endforelse
        </tbody>
    </table>
    <br>
    <table border="1" cellpadding="3" cellspacing="0">
        <thead>
            <tr>
                <th>Diplôme</th><th>Niveau</th>
                <th>Capacité d'accueil</th><th>Effectif inscrits</th><th>Écart</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recapEffectifs as $re)
            <tr>
                <td>{{ ($re->libellediplome ?? '') . ' ' . ($re->libellefiliere ?? '') }}</td>
                <td>{{ $re->libelleniveau ?? '' }}</td>
                <td>{{ $re->capaciteacceuil ?? '' }}</td>
                <td>{{ $re->EFFECTIFS ?? '' }}</td>
                <td>{{ ($re->capaciteacceuil ?? 0) - ($re->EFFECTIFS ?? 0) }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="empty-cell">Aucune donnée existante.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h3 class="section">4.5. Cours du soir</h3>
    <table border="1" cellpadding="3" cellspacing="0">
        <thead>
            <tr>
                <th rowspan="2">Filière</th>
                <th rowspan="2">Diplôme</th>
                <th rowspan="2">Niveau</th>
                <th colspan="3">Effectif</th>
                <th rowspan="2">Total général</th>
            </tr>
            <tr>
                <th>F</th><th>G</th><th>T</th>
            </tr>
        </thead>
        <tbody>
            @foreach([['BTS','1ère année'],['BTS','2ème année'],['BAC','Seconde'],['BAC','Première'],['BAC','Terminale'],['BT','1A'],['BT','2A'],['BT','3A'],['CAP','1A'],['CAP','2A'],['CAP','3A']] as $ligne)
            <tr>
                <td></td>
                <td>{{ $ligne[0] }}</td>
                <td>{{ $ligne[1] }}</td>
                <td></td><td></td><td></td><td></td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" style="font-weight:bold; text-align:center;">TOTAL</td>
                <td></td><td></td><td></td><td></td>
            </tr>
        </tbody>
    </table>
</div>

{{-- ══════════════════════════════════════════════════════════════════════
     5. BILAN DES MISES EN STAGE DE VACANCES  [NOUVEAU]
══════════════════════════════════════════════════════════════════════ --}}
<div style="page-break-after:always;">
    <p style="font-weight:bold; font-size:14px;">5. BILAN DES MISES EN STAGE DE VACANCES</p>

    <h3 class="section">5.1. Taux de mise en stage</h3>
    @if($nbre_misesenstagevacances > 0)
        <table border="1" cellpadding="3" cellspacing="0">
            <thead>
                <tr>
                    <th style="width:4%">N°</th>
                    <th>Filière</th>
                    <th>Nombre de stagiaires</th>
                    <th>Nombre mis en stage</th>
                    <th>Taux (%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($misesenstagevacances as $ms)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ms->libellefiliere ?? '' }}</td>
                    <td>{{ $ms->nombre_stagiaires ?? '' }}</td>
                    <td>{{ $ms->nombre_mis_en_stages ?? '' }}</td>
                    <td>
                        @if(!empty($ms->taux))
                            {{ number_format($ms->taux, 2) }}%
                        @elseif(!empty($ms->nombre_stagiaires) && $ms->nombre_stagiaires > 0)
                            {{ number_format(($ms->nombre_mis_en_stages / $ms->nombre_stagiaires) * 100, 2) }}%
                        @else
                            —
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="ras">Aucune donnée existante.</p>
    @endif

    <h3 class="section">5.2. Analyse de la situation</h3>
    @if(!empty($analysesituation))
        <p>{{ $analysesituation }}</p>
    @else
        <p class="ras">R A S</p>
    @endif
</div>

{{-- ══════════════════════════════════════════════════════════════════════
     6. POINT D'EXÉCUTION DES PROGRAMMES ET PROGRESSIONS
══════════════════════════════════════════════════════════════════════ --}}
<div style="page-break-after:always;">
    <p style="font-weight:bold; font-size:14px;">6. POINT DE L'EXÉCUTION DES PROGRAMMES ET PROGRESSIONS</p>
    <table border="1" cellpadding="3" cellspacing="0">
        <thead>
            <tr>
                <th>N°</th>
                <th>Discipline</th>
                <th>Nbre total chapitres</th>
                <th>Nbre chapitres exécutés</th>
                <th>% Chapitres exécutés</th>
                <th>Nbre total leçons</th>
                <th>Nbre leçons exécutées</th>
                <th>% Leçons exécutées</th>
                <th>Observations</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pointexecutions as $pe)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pe->libellediscipline ?? '' }}</td>
                <td>{{ $pe->total_chapitre ?? '' }}</td>
                <td>{{ $pe->chapitres_execute ?? '' }}</td>
                <td>{{ $pe->pourcentage_chapitre ? number_format($pe->pourcentage_chapitre,2).'%' : '' }}</td>
                <td>{{ $pe->total_lecon ?? '' }}</td>
                <td>{{ $pe->lecons_execute ?? '' }}</td>
                <td>{{ $pe->pourcentage_lecon ? number_format($pe->pourcentage_lecon,2).'%' : '' }}</td>
                <td>{{ $pe->observations ?? '' }}</td>
            </tr>
            @empty
            <tr><td colspan="9" class="empty-cell">Aucune donnée existante.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ══════════════════════════════════════════════════════════════════════
     7. INDICATEURS DE PERFORMANCE
══════════════════════════════════════════════════════════════════════ --}}
<div style="page-break-after:always;">
    <p style="font-weight:bold; font-size:14px;">7. INDICATEURS DE PERFORMANCE</p>
    <table border="1" cellpadding="3" cellspacing="0">
        <thead>
            <tr>
                <th>N°</th>
                <th>Indicateurs-clés de performance</th>
                <th>Taux obtenu en 2024-2025</th>
                <th>La cible en 2025-2026</th>
            </tr>
        </thead>
        <tbody>
            @forelse($indicateurs as $ind)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $ind->libelleitems ?? '' }}</td>
                <td>{{ $ind->tauxobtenu_n1 ?? '' }}</td>
                <td>{{ $ind->tauxcible ?? '' }}</td>
            </tr>
            @empty
            <tr><td colspan="4" class="empty-cell">Aucune donnée existante.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ══════════════════════════════════════════════════════════════════════
     8. INFRASTRUCTURES ET LOCAUX
══════════════════════════════════════════════════════════════════════ --}}
<div style="page-break-after:always;">
    <p style="font-weight:bold; font-size:14px;">8. INFRASTRUCTURES ET LOCAUX</p>

    <h3 class="section">8.1. Bâtiments</h3>
    @if($nbre_infrastructures > 0)
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th style="width:4%">N°</th>
                    <th>Libellé</th>
                    <th>Nombre</th>
                    <th>Capacité</th>
                    <th>Nombre de bureaux</th>
                    <th>Observation</th>
                </tr>
            </thead>
            <tbody>
                @foreach($infrastructures as $infra)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $infra->libelleinfrastructure ?? '' }}</td>
                    <td>{{ $infra->nombre ?? '' }}</td>
                    <td>{{ $infra->cap ?? '' }}</td>
                    <td>{{ $infra->nombrebureaux ?? '' }}</td>
                    <td>{{ $infra->obs ?? '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="ras">Aucune donnée existante.</p>
    @endif

    <h3 class="section">8.2. Clôture</h3>
    <ul>
        <li>Existe-t-il une clôture ? : ……………</li>
        <li>Si oui, dans quel état est-elle ? : ……………</li>
    </ul>

    <h3 class="section">8.3. Problèmes liés aux infrastructures</h3>
    <p>……………………………………………………………………………………………………………</p>
</div>

{{-- ══════════════════════════════════════════════════════════════════════
     9. INVENTAIRE GÉNÉRAL DU MATÉRIEL ET DES ÉQUIPEMENTS
══════════════════════════════════════════════════════════════════════ --}}
<div style="page-break-after:always;">
    <p style="font-weight:bold; font-size:14px;">9. INVENTAIRE GÉNÉRAL DU MATÉRIEL ET DES ÉQUIPEMENTS</p>

    <h3 class="section">9.1. Matériel</h3>
    <ul>
        <li>Existe-t-il un inventaire ? : ……………</li>
        <li>Si oui, quelle est la date du dernier inventaire transmis à la hiérarchie ? : ……………</li>
        <li>Avez-vous les programmes d'enseignement pour vos différentes filières ? : ……………</li>
    </ul>

    <h3 class="section">9.2. Équipements</h3>
    @if($nbre_equipements > 0)
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th style="width:4%">N°</th>
                    <th>Matériel</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                @foreach($equipements as $eq)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $eq->libellemateriel ?? '' }}</td>
                    <td>{{ $eq->nombre ?? '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="ras">Aucune donnée existante.</p>
    @endif
    <ul style="margin-top:8px;">
        <li>Existe-t-il un inventaire ? : ……………</li>
        <li>Si oui, quelle est la date du dernier inventaire transmis à la hiérarchie ? : ……………</li>
    </ul>
</div>

{{-- ══════════════════════════════════════════════════════════════════════
     10. GESTION FINANCIÈRE
══════════════════════════════════════════════════════════════════════ --}}
<div style="page-break-after:always;">
    <p style="font-weight:bold; font-size:14px;">10. GESTION FINANCIÈRE</p>

    <h3 class="section">10.1. État d'exécution du budget</h3>
    <table border="1" cellpadding="3" cellspacing="0">
        <thead>
            <tr>
                <th>N°</th><th>Ligne budgétaire</th><th>Désignation</th>
                <th>Montant</th><th>Engagement réalisé</th><th>Solde</th>
            </tr>
        </thead>
        <tbody>
            @if($executionbudgets->count() > 0)
                @php $totDot=0; $totEng=0; $totSol=0; @endphp
                @foreach($executionbudgets as $eb)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $eb->ligne_budgetaire ?? '' }}</td>
                    <td>{{ $eb->designation ?? '' }}</td>
                    <td>{{ number_format($eb->dotation ?? 0, 0, ',', ' ') }}</td>
                    <td>{{ number_format($eb->engagement ?? 0, 0, ',', ' ') }}</td>
                    <td>{{ number_format($eb->solde ?? 0, 0, ',', ' ') }}</td>
                </tr>
                @php $totDot += $eb->dotation ?? 0; $totEng += $eb->engagement ?? 0; $totSol += $eb->solde ?? 0; @endphp
                @endforeach
                <tr style="font-weight:bold;">
                    <td colspan="3" style="text-align:center;">TOTAL DOTATION BUDGÉTAIRE</td>
                    <td>{{ number_format($totDot,0,',',' ') }}</td>
                    <td>{{ number_format($totEng,0,',',' ') }}</td>
                    <td>{{ number_format($totSol,0,',',' ') }}</td>
                </tr>
            @else
                <tr><td colspan="6" class="empty-cell">Aucune donnée existante.</td></tr>
            @endif
        </tbody>
    </table>

    <h3 class="section">10.2. Ressources additionnelles</h3>
    <ul>
        <li>Compte ouvert à la Banque du Trésor.</li>
    </ul>
    @if($ressourcesadditionnelles->count() > 0)
        @foreach($ressourcesadditionnelles as $ra)
        <p><strong>Banque :</strong> {{ $ra->banque ?? '' }}&nbsp;&nbsp;
           <strong>Numéro du compte :</strong> {{ $ra->numero_compte ?? '' }}</p>
        @endforeach
    @else
        <p>- Numéro du compte : …………………………………</p>
        <p>- Sinon dans quel établissement financier est domicilié le Compte ? ……………</p>
        <p>- Numéro du Compte : ………………………………</p>
    @endif

    {{-- [NOUVEAU] Frais scolarité COURS DU JOUR --}}
    <h3 class="section">10.3. Frais d'inscription et de scolarité (cours du jour)</h3>
    <table border="1" cellpadding="3" cellspacing="0">
        <thead>
            <tr>
                <th>N°</th><th>Nature</th><th>Nombre d'élèves</th>
                <th>Total perçus</th><th>Part établissement</th><th>Part fonds école</th><th>Observations</th>
            </tr>
        </thead>
        <tbody>
            @if($fraisscolaritesjour->count() > 0)
                @php $totEl=0; $totPer=0; $totEt=0; $totFo=0; @endphp
                @foreach($fraisscolaritesjour as $fs)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fs->nature ?? '' }}</td>
                    <td>{{ $fs->nombre_eleve ?? '' }}</td>
                    <td>{{ number_format($fs->total_percus ?? 0, 0, ',', ' ') }}</td>
                    <td>{{ number_format($fs->part_etab ?? 0, 0, ',', ' ') }}</td>
                    <td>{{ number_format($fs->part_fonds ?? 0, 0, ',', ' ') }}</td>
                    <td>{{ $fs->observations ?? '' }}</td>
                </tr>
                @php $totEl += $fs->nombre_eleve ?? 0; $totPer += $fs->total_percus ?? 0; $totEt += $fs->part_etab ?? 0; $totFo += $fs->part_fonds ?? 0; @endphp
                @endforeach
                <tr style="font-weight:bold;">
                    <td colspan="2" style="text-align:center;">TOTAL</td>
                    <td>{{ $totEl }}</td>
                    <td>{{ number_format($totPer,0,',',' ') }}</td>
                    <td>{{ number_format($totEt,0,',',' ') }}</td>
                    <td>{{ number_format($totFo,0,',',' ') }}</td>
                    <td></td>
                </tr>
            @else
                <tr>
                    <td>01</td><td>Frais d'inscription</td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                    <td>02</td><td>Frais de scolarité</td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                <tr style="font-weight:bold;">
                    <td colspan="2" style="text-align:center;">TOTAL</td>
                    <td></td><td></td><td></td><td></td><td></td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- Frais scolarité COURS DU SOIR --}}
    <h3 class="section">Frais d'inscription et de scolarité (cours du soir)</h3>
    <table border="1" cellpadding="3" cellspacing="0">
        <thead>
            <tr>
                <th>N°</th><th>Nature</th><th>Nombre d'élèves</th>
                <th>Total perçus</th><th>Part établissement</th><th>Part fonds école</th><th>Observations</th>
            </tr>
        </thead>
        <tbody>
            @if($fraisscolaritessoir->count() > 0)
                @php $totEl=0; $totPer=0; $totEt=0; $totFo=0; @endphp
                @foreach($fraisscolaritessoir as $fs)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fs->nature ?? '' }}</td>
                    <td>{{ $fs->nombre_eleve ?? '' }}</td>
                    <td>{{ number_format($fs->total_percus ?? 0, 0, ',', ' ') }}</td>
                    <td>{{ number_format($fs->part_etab ?? 0, 0, ',', ' ') }}</td>
                    <td>{{ number_format($fs->part_fonds ?? 0, 0, ',', ' ') }}</td>
                    <td>{{ $fs->observations ?? '' }}</td>
                </tr>
                @php $totEl += $fs->nombre_eleve ?? 0; $totPer += $fs->total_percus ?? 0; $totEt += $fs->part_etab ?? 0; $totFo += $fs->part_fonds ?? 0; @endphp
                @endforeach
                <tr style="font-weight:bold;">
                    <td colspan="2" style="text-align:center;">TOTAL</td>
                    <td>{{ $totEl }}</td>
                    <td>{{ number_format($totPer,0,',',' ') }}</td>
                    <td>{{ number_format($totEt,0,',',' ') }}</td>
                    <td>{{ number_format($totFo,0,',',' ') }}</td>
                    <td></td>
                </tr>
            @else
                <tr>
                    <td>01</td><td>Frais d'inscription</td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                    <td>02</td><td>Frais de scolarité</td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                <tr style="font-weight:bold;">
                    <td colspan="2" style="text-align:center;">TOTAL</td>
                    <td></td><td></td><td></td><td></td><td></td>
                </tr>
            @endif
        </tbody>
    </table>

    <h3 class="section">10.4. Autres ressources (productions et travaux extérieurs)</h3>
    <table border="1" cellpadding="3" cellspacing="0">
        <thead>
            <tr>
                <th>Nature</th><th>Clients</th><th>Montant prévisionnel</th>
                <th>Part établissement</th><th>Part versée au fond école</th><th>Observations</th>
            </tr>
        </thead>
        <tbody>
            @if($travauxexterieurs->count() > 0)
                @php $totMo=0; $totEt=0; $totFo=0; @endphp
                @foreach($travauxexterieurs as $tx)
                <tr>
                    <td>{{ $tx->nature ?? '' }}</td>
                    <td>{{ $tx->client ?? '' }}</td>
                    <td>{{ number_format($tx->montant_previsionnel ?? 0, 0, ',', ' ') }}</td>
                    <td>{{ number_format($tx->part_etab ?? 0, 0, ',', ' ') }}</td>
                    <td>{{ number_format($tx->part_fonds ?? 0, 0, ',', ' ') }}</td>
                    <td>{{ $tx->observations ?? '' }}</td>
                </tr>
                @php $totMo += $tx->montant_previsionnel ?? 0; $totEt += $tx->part_etab ?? 0; $totFo += $tx->part_fonds ?? 0; @endphp
                @endforeach
                <tr style="font-weight:bold;">
                    <td>TOTAL</td><td></td>
                    <td>{{ number_format($totMo,0,',',' ') }}</td>
                    <td>{{ number_format($totEt,0,',',' ') }}</td>
                    <td>{{ number_format($totFo,0,',',' ') }}</td>
                    <td></td>
                </tr>
            @else
                <tr><td colspan="6" class="empty-cell">Aucune donnée existante.</td></tr>
            @endif
        </tbody>
    </table>
</div>

{{-- ══════════════════════════════════════════════════════════════════════
     11. COMITÉ DE GESTION
══════════════════════════════════════════════════════════════════════ --}}
<div style="page-break-after:always;">
    <p style="font-weight:bold; font-size:14px;">11. COMITÉ DE GESTION</p>
    <p style="text-decoration:underline; font-weight:bold;">Bureau</p>
    @if($comitegestions->count() > 0)
        @foreach($comitegestions as $cg)
            @if($cg->libellemembrecomite)
            <p style="font-weight:bold;">{{ $cg->libellemembrecomite }} :</p>
            <p>{{ $cg->nomprenoms ?? '' }}</p>
            @endif
        @endforeach
    @else
        <p><strong>Président :</strong></p>
        <p><strong>Vice-Président :</strong></p>
        <p><strong>Secrétaire Général :</strong></p>
        <p><strong>Secrétaire Général Adjoint :</strong></p>
        <p><strong>Trésorier Général :</strong></p>
        <p><strong>Trésorier Général Adjoint :</strong></p>
    @endif
</div>

{{-- ══════════════════════════════════════════════════════════════════════
     12. ACTIVITÉS SOCIO-ÉDUCATIVES
══════════════════════════════════════════════════════════════════════ --}}
<div style="page-break-after:always;">
    <p style="font-weight:bold; font-size:14px;">12. ACTIVITÉS SOCIO-ÉDUCATIVES</p>

    <h3 class="section">12.1. Activités sportives</h3>
    @if($nbre_activites > 0)
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr><th style="width:4%">N°</th><th>Activités sportives</th></tr>
            </thead>
            <tbody>
                @foreach($activites as $act)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $act->libellesport ?? '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="ras">Aucune donnée existante.</p>
    @endif

    <h3 class="section">12.2. Clubs et associations</h3>
    @if($nbre_associations > 0)
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>Désignation</th><th>Objet</th>
                    <th>Nom du responsable</th><th>Contact</th>
                </tr>
            </thead>
            <tbody>
                @foreach($associations as $asso)
                <tr>
                    <td>{{ $asso->designation ?? '' }}</td>
                    <td>{{ $asso->objet ?? '' }}</td>
                    <td>{{ $asso->nomresponsable ?? '' }}</td>
                    <td>{{ $asso->contact ?? '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="ras">Aucune donnée existante.</p>
    @endif
</div>

{{-- ══════════════════════════════════════════════════════════════════════
     13. PROBLÈMES URGENTS
══════════════════════════════════════════════════════════════════════ --}}
<div style="page-break-after:always;">
    <p style="font-weight:bold; font-size:14px;">13. PROBLÈMES URGENTS</p>
    @if($nbre_probleme > 0)
        @foreach($probleme_urgents as $pb)
            <p>{{ $pb->libelleprobleme ?? '' }}</p>
        @endforeach
    @else
        <p class="ras">R A S</p>
    @endif

    {{-- [NOUVEAU] Perspectives --}}
    <p style="font-weight:bold; font-size:14px; margin-top:20px;">14. PERSPECTIVES</p>
    @if($nbre_perspectives > 0)
        @foreach($perspectives as $pv)
            <p>{{ $pv->libelleperspective ?? '' }}</p>
        @endforeach
    @else
        <p class="ras">R A S</p>
    @endif

    <p style="font-weight:bold; font-size:14px; margin-top:20px; text-align:center;">CONCLUSION</p>
    @if($nbre_conclusions > 0)
        @foreach($conclusions as $co)
            <p>{{ $co->libelleconclusion ?? '' }}</p>
        @endforeach
    @else
        <p class="ras">R A S</p>
    @endif
</div>

{{-- ══════════════════════════════════════════════════════════════════════
     ANNEXES
══════════════════════════════════════════════════════════════════════ --}}
<div class="page-break">
    <p style="font-weight:bold; font-size:16px; text-align:center;">ANNEXES</p>
    <p style="font-style:italic; text-align:center;">(À relier séparément du rapport)</p>
</div>

{{-- Annexe : Liste des apprenants par classe --}}
<div style="page-break-after:always;">
    <p style="font-weight:bold;">LISTE DES ÉLÈVES PAR CLASSE</p>
    @if($nbre_apprenants > 0)
        <table border="1" cellspacing="0" style="font-size:10px !important;">
            <thead>
                <tr>
                    <th style="width:4%">N°</th>
                    <th style="width:5%">Sexe</th>
                    <th style="width:9%">Matricule</th>
                    <th>Nom &amp; Prénoms</th>
                    <th style="width:8%">Date naissance</th>
                    <th>Lieu naissance</th>
                    <th>Nationalité</th>
                    <th>Classe</th>
                    <th>Statut</th>
                    <th>Téléphone</th>
                    <th style="width:8%">Handicap</th>
                </tr>
            </thead>
            <tbody>
                @foreach($apprenants as $ap)
                <tr style="text-align:center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ap->sexe ?? '' }}</td>
                    <td>{{ $ap->matriculeap ?? '' }}</td>
                    <td>{{ $ap->nom . ' ' . $ap->prenoms }}</td>
                    <td>{{ $ap->datenaissance ?? '' }}</td>
                    <td>{{ $ap->lieunaissance ?? '' }}</td>
                    <td>{{ $ap->nationalite ?? '' }}</td>
                    <td>{{ $ap->la_classe ?? '' }}</td>
                    <td>{{ $ap->libellestatutap ?? '' }}</td>
                    <td>{{ $ap->telephone ?? '' }}</td>
                    <td>{{ $ap->libelle_handicap ?? 'Sans handicap' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="ras">Aucune donnée existante.</p>
    @endif
</div>

{{-- [NOUVEAU] Annexe : Liste du personnel enseignant (via vue SQL listepaersonnelenseignant) --}}
<div style="page-break-after:always;">
    <p style="font-weight:bold;">LISTE DU PERSONNEL ENSEIGNANT</p>
    @if($listepersonnelenseignant->count() > 0)
        <table border="1" cellspacing="0" style="font-size:10px !important;">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nom</th>
                    <th>Prénoms</th>
                    <th>Date naissance</th>
                    <th>Lieu naissance</th>
                    <th>Sexe</th>
                    <th>Fonction</th>
                    <th>Discipline</th>
                    <th>Emploi</th>
                    <th>Contacts</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listepersonnelenseignant as $lpe)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $lpe->nom ?? '' }}</td>
                    <td>{{ $lpe->prenoms ?? '' }}</td>
                    <td>{{ $lpe->datenaissance ?? '' }}</td>
                    <td>{{ $lpe->lieunaissance ?? '' }}</td>
                    <td>{{ $lpe->sexe ?? '' }}</td>
                    <td>{{ $lpe->libellefonction ?? '' }}</td>
                    <td>{{ $lpe->libellediscipline ?? '' }}</td>
                    <td>{{ $lpe->emploi ?? '' }}</td>
                    <td>{{ $lpe->telephone ?? '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="ras">Aucune donnée existante.</p>
    @endif
</div>

{{-- [NOUVEAU] Annexe : Liste du personnel administratif non enseignant (vue listepersonneladminautre) --}}
<div style="page-break-after:always;">
    <p style="font-weight:bold;">LISTE DU PERSONNEL ADMINISTRATIF NON ENSEIGNANT</p>
    @if($listepersonneladminautre->count() > 0)
        <table border="1" cellspacing="0" style="font-size:10px !important;">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nom</th>
                    <th>Prénoms</th>
                    <th>Date naissance</th>
                    <th>Lieu naissance</th>
                    <th>Sexe</th>
                    <th>Fonction</th>
                    <th>Emploi</th>
                    <th>Contacts</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listepersonneladminautre as $lpa)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $lpa->nom ?? '' }}</td>
                    <td>{{ $lpa->prenoms ?? '' }}</td>
                    <td>{{ $lpa->datenaissance ?? '' }}</td>
                    <td>{{ $lpa->lieunaissance ?? '' }}</td>
                    <td>{{ $lpa->sexe ?? '' }}</td>
                    <td>{{ $lpa->libellefonction ?? '' }}</td>
                    <td>{{ $lpa->emploi ?? '' }}</td>
                    <td>{{ $lpa->telephone ?? '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="ras">Aucune donnée existante.</p>
    @endif
</div>

{{-- Annexe : Emplois du temps des classes --}}
<div style="page-break-after:always;">
    <p style="font-weight:bold;">EMPLOIS DU TEMPS DES CLASSES</p>
    @foreach($emploisParClasse as $classe => $emploisClasse)
    <div class="no-break" style="margin: 10px 0 30px 0;">
        <div class="edt-header">EMPLOI DU TEMPS — {{ strtoupper($classe) }}</div>
        <table class="edt-table">
            <thead>
                <tr>
                    <th style="width:10%">HEURES</th>
                    @foreach(['LUNDI','MARDI','MERCREDI','JEUDI','VENDREDI','SAMEDI'] as $jour)
                    <th>{{ $jour }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                $plages = [
                    ['08:00','09:00'],['09:00','10:00'],['10:00','11:00'],
                    ['11:00','12:00'],['12:00','13:00'],['13:00','14:00'],
                    ['14:00','15:00'],['15:00','16:00'],['16:00','17:00'],
                ];
                @endphp
                @foreach($plages as $h)
                <tr>
                    <td class="edt-heure">{{ $h[0] }}<br>{{ $h[1] }}</td>
                    @foreach(['LUNDI','MARDI','MERCREDI','JEUDI','VENDREDI','SAMEDI'] as $jour)
                        @if($h[0] === '12:00')
                            <td class="edt-pause">PAUSE</td>
                        @else
                            @php
                            $cours = $emploisClasse->first(fn($i) => $i->DEBUT === $h[0] && !empty($i->$jour));
                            @endphp
                            <td>@if($cours)<div style="font-size:7px; font-weight:bold;">{{ $cours->$jour }}</div>@endif</td>
                        @endif
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach
</div>

{{-- Annexe : Emplois du temps des professeurs --}}
<div>
    <p style="font-weight:bold;">EMPLOIS DU TEMPS DES PROFESSEURS</p>
    @foreach($emploisParProf as $nomComplet => $emploisProf)
    <div class="no-break" style="margin-bottom:20px;">
        <p style="font-weight:bold;">Professeur : {{ $nomComplet }}</p>
        <table border="1" cellpadding="5" cellspacing="0" style="font-size:11px !important; text-align:center;">
            <thead>
                <tr>
                    <th>Horaires</th>
                    <th>Lundi</th><th>Mardi</th><th>Mercredi</th>
                    <th>Jeudi</th><th>Vendredi</th><th>Samedi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($emploisProf as $ep)
                <tr>
                    <td>{{ $ep->DEBUT }} - {{ $ep->FIN }}</td>
                    @foreach(['LUNDI','MARDI','MERCREDI','JEUDI','VENDREDI','SAMEDI'] as $j)
                    <td style="{{ empty($ep->$j) ? 'background-color:#d3d3d3;' : '' }}">
                        {!! nl2br(e($ep->$j ?? '')) !!}
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach
</div>

</body>
</html>
