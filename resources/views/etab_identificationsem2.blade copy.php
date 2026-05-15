<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
                    RAPPORT DU 2EME SEMESTRE DES ETABLISSEMENTS SCOLAIRES PRIVES </h3>

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
                        {{ $etablissements->sigle ?? 'Non renseigné' }}
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
                <br>
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
                            <th style="width: 5%">Matricule</th>
                            <th style="width: 5%">Sexe</th>
                            <th>Type de personnel</th>
                            <th style="width: 8%">Date de naissance</th>
                            <th>Lieu de naissance</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Diplome</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personnels as $personnel)
                        <tr style="text-align: center">
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
                                Aucune
                                donnée
                                existante.</td>
                        </tr>
                    </tbody>
                </table>
                @endif

                <br><br>
                <p>
                    <span style="font-family: Helvetica; font-weight: bold">Besoin en personnel administratif</span>
                </p>

                @if ($nbre_besoinpersonnel_admins > 0)
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed; font-size: 14px !important; text-align: center">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Fonction</th>
                            <th>Type de personnel</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($besoinpersonnel_admins as $besoinpersonnel_admin)
                        <tr>
                            <td style="height: 35px;">{{ $loop->iteration }}</td>
                            <td>{{ $besoinpersonnel_admin->libellefonction ?? 'Non renseigné' }}</td>
                            <td>{{ $besoinpersonnel_admin->libelletypepersonnel ?? 'Non renseigné' }}</td>
                            <td>{{ $besoinpersonnel_admin->nombre ?? 'Non renseigné' }}</td>
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
                            <th>Nombre</th>
                            <th>Fonction</th>
                            <th>Type de personnel</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4"
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
                    <span style="font-family: Helvetica; font-weight: bold">Besoin en personnel enseignant</span>
                </p>

                @if ($nbre_besoinpersonnelens > 0)
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

                        @foreach ($besoinpersonnelens as $besoinpersonnelen)
                        <tr>
                            <td style="height: 35px;">{{ $loop->iteration }}</td>
                            <td>{{ $besoinpersonnelen->libelleniveau ?? 'Non renseigné' }}</td>
                            <td>{{ $besoinpersonnelen->libellediscipline ?? 'Non renseigné' }}</td>
                            <td>{{ $besoinpersonnelen->nombre ?? 'Non renseigné' }}</td>
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
                            <th>Niveau</th>
                            <th>Type de personnel</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4"
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
                                Aucune
                                donnée
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
                            <th style="width: 9%">Matricule</th>
                            <th>Nom & Prénoms</th>
                            <th style="width: 8%">Date de naissance</th>
                            <th>Lieu de naissance</th>
                            <th style="width: 5%">Sexe</th>
                            <th>Nationalité</th>
                            <th>Classe</th>
                            <th>Handicap</th>
                            <th>Moyenne 2eme semestre</th>
                            <th>Moyenne annuelle</th>
                            <th>DFA</th>
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
                            <td>{{ $apprenant->moyenne2eme ?? '' }}</td>
                            <td>{{ $apprenant->moyenneannee ?? '' }}</td>
                            <td>{{ $apprenant->libelledecision ?? '' }}</td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
                @else
                <table border="1" cellpadding="15" cellspacing="0"
                    style="width: 100%; table-layout: fixed;">
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
                            <th>Moyenne 2eme semestre</th>
                            <th>Moyenne annuelle</th>
                            <th>DFA</th>
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
                    <span style="font-family: Helvetica; font-weight: bold">Résulats aux examens</span>
                </p>

                @if ($nbre_resultatexamens > 0)
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed;font-size: 14px !important; text-align: center;">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Diplome préparé</th>
                            <th>Filières</th>
                            <th>Filles</th>
                            <th>Garçons</th>
                            <th>Total</th>
                            <th>Nombre de fille admises</th>
                            <th>Nombre de gaçon admis </th>
                            <th>Nombre d'admis total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resultatexamens as $resultatexamen)
                        <tr>
                            <td style="height: 35px;">{{ $loop->iteration }}</td>
                            <td>{{ $resultatexamen->libellediplome ?? 'Non renseigné' }}</td>
                            <td>{{ $resultatexamen->libellefiliere ?? 'Non renseigné' }}</td>
                            <td>{{ $resultatexamen->nombrecandidat_f ?? 'Non renseigné' }}</td>
                            <td>{{ $resultatexamen->nombrecandidat_g ?? 'Non renseigné' }}</td>
                            <td>{{ $resultatexamen->nombrecandidat_t ?? 'Non renseigné' }}</td>
                            <td>{{ $resultatexamen->nombreadmis_f ?? 'Non renseigné' }}</td>
                            <td>{{ $resultatexamen->nombreadmis_g ?? 'Non renseigné' }}</td>
                            <td>{{ $resultatexamen->nombreadmis_t ?? 'Non renseigné' }}</td>

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
                            <th>Diplome préparé</th>
                            <th>Filières</th>
                            <th>Filles</th>
                            <th>Garçons</th>
                            <th>Total</th>
                            <th>Nombre de fille admises</th>
                            <th>Nombre de garçon admis </th>
                            <th>Nombre d'admis total</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="9"
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
                    <span style="font-family: Helvetica; font-weight: bold">Infrastructures et locaux</span>
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
                                Aucune
                                donnée
                                existante.</td>
                        </tr>
                    </tbody>
                </table>
                @endif


                <br><br>
                <p>
                    <span style="font-family: Helvetica; font-weight: bold">Besoin en matériels et divers</span>
                </p>

                @if ($nbre_besoinsenmateriels > 0)
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed; font-size: 14px !important; text-align: center">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Quantité</th>
                            <th>Matériel</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($besoinsenmateriels as $besoinsenmateriel)
                        <tr>
                            <td style="height: 35px;">{{ $loop->iteration }}</td>
                            <td>{{ $besoinsenmateriel->quantite ?? 'Non renseigné' }}</td>
                            <td>{{ $besoinsenmateriel->libellemateriel ?? 'Non renseigné' }}</td>
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
                            <th>Quantité</th>
                            <th>Matériel</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3"
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
                    <span style="font-family: Helvetica; font-weight: bold">Les prévisions</span>
                </p>

                @if ($nbre_previsions > 0)
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed; font-size: 14px !important; text-align: center">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Contenu</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($previsions as $prevision)
                        <tr>
                            <td style="height: 35px;">{{ $loop->iteration }}</td>
                            <td>{{ $prevision->libelleprevision ?? 'Non renseigné' }}</td>
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
                                Aucune
                                donnée
                                existante.</td>
                        </tr>
                    </tbody>
                </table>
                @endif


                <br><br>
                <p>
                    <span style="font-family: Helvetica; font-weight: bold">Etat des difficultés de gestion et
                        suggestions</span>
                </p>

                @if ($nbre_etatgestions > 0)
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed; font-size: 14px !important; text-align: center">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Nature</th>
                            <th>Difficultés</th>
                            <th>Causes</th>
                            <th>Suggestions</th>
                            <th>Observations</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($etatgestions as $etatgestion)
                        <tr>
                            <td style="height: 35px;">{{ $loop->iteration }}</td>
                            <td>{{ $etatgestion->nature ?? 'Non renseigné' }}</td>
                            <td>{{ $etatgestion->difficultes ?? 'Non renseigné' }}</td>
                            <td>{{ $etatgestion->causes ?? 'Non renseigné' }}</td>
                            <td>{{ $etatgestion->suggestions ?? 'Non renseigné' }}</td>
                            <td>{{ $etatgestion->observations ?? 'Non renseigné' }}</td>
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
                            <th>Nature</th>
                            <th>Difficultés</th>
                            <th>Causes</th>
                            <th>Suggestions</th>
                            <th>Observations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6"
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

                {{-- A VERIFIER AVANT DE SUPPRIMER --}}

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
                                Aucune
                                donnée
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
                                Aucune
                                donnée
                                existante.</td>
                        </tr>
                    </tbody>
                </table>
                @endif


                <br><br>
                {{-- A VERIFIER AVANT DE SUPPRIMER --}}

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
                                Aucune
                                donnée
                                existante.</td>
                        </tr>
                    </tbody>
                </table>
                @endif
            </div>
        </div>
</body>

</html>