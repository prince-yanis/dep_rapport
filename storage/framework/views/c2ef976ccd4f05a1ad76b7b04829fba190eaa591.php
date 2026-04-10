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
            <!-- <img src="<?php echo e(url('https://formation-professionnelle.gouv.ci/wp-content/uploads/2023/06/LOGO-SITE-02-1.png'), false); ?>" height="120"> -->
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
                        <b><?php echo e($etablissements->denominationetab ?? 'Non renseigné', false); ?></b> &nbsp; &nbsp; &nbsp; Sigle:
                        <?php echo e($etablissements->sigle ?? 'Non renseigné', false); ?>

                    </span>
                </p>

                <p style="margin-top: 7.1pt;font-family: Helvetica; font-weight: bold">I-2. Contacts de l'établissement
                </p>
                <br>

                <p class="ListParagraph" style="margin-top: 1.8pt; font-family: Helvetica">
                    <span style="font-family: Helvetica">Téléphone de l'établissement Cel :
                        <b><?php echo e($etablissements->contact ?? 'Non renseigné', false); ?></b></span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="font-family: Helvetica">Fixe : </span>
                </p>

                <p class="ListParagraph" style="margin-top: 4pt; font-family: Helvetica">
                    <span style="font-family: Helvetica">Nom et Prénoms du Fondateur:
                        <b><?php echo e($etablissements->nomfondateur ?? 'Non renseigné', false); ?></b>
                </p>

                <br>

                <p style="margin-top: 8.65pt;font-family: Helvetica; letter-spacing: -0.1pt;">
                    I-3. Ordre d'enseignement de l'établissement:
                    <span style="font-family: Helvetica; letter-spacing: -0.1pt; font-weight: normal !important;">
                        <b><?php echo e($etablissements->libelleenseignement, false); ?></b></span>

                </p>

                <p style="margin-top: 8.65pt; font-family: Helvetica;">
                    I-4. Code de L'établissement :
                    <span style="font-family: Helvetica; letter-spacing: -0.1pt">
                        <b><?php echo e($etablissements->code, false); ?></b></span>
                    &nbsp;
                </p>
                <br>
                <br>
                <p style="margin-top: 5.25pt">
                    <span style="font-family: Helvetica; font-weight: bold">I-6. Localisation</span>
                </p>
                <p style="margin-top: 8pt">
                    <span style="font-family: Helvetica">I-6-1. Direction régionale :
                        <b><?php echo e($etablissements->denominationdd ?? 'Non renseigné', false); ?> </b></span>
                </p>

                <p style="margin-top: 6.75pt">
                    <span style="font-family: Helvetica; letter-spacing: -0.1pt">I-6-1. Commune:
                        <b><?php echo e($etablissements->denominationcommune ?? 'Non renseigné', false); ?></b>. &nbsp; &nbsp;&nbsp; &nbsp;
                </p>
                <p style="margin-top: 6.75pt">
                    <span style="font-family: Helvetica; letter-spacing: -0.1pt">I-6-2. Quartier :
                        <b> <?php echo e($etablissements->localisation ?? 'Non renseigné', false); ?> </b></span>
                </p>

                <p style="margin-top: 6.1pt">
                    <span style="font-family: Helvetica; vertical-align: 0.5pt">1-6-3. GPS (Coordonnées) :
                        <b> <?php echo e($etablissements->latitude ?? 'Pas', false); ?> ,
                            <?php echo e($etablissements->longitude ?? 'indiqué', false); ?></b></span>
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
                    <span style="font-family: Helvetica; ">1-7-1-1. <?php echo e($etablissements->libelleenseignement, false); ?> :
                        <b> <?php echo e($etablissements->numautorisationcreation ?? 'Non renseigné', false); ?> </b> </span>
                </p>

                <p style="margin-top: 8.9pt">
                    <span style="font-family: Helvetica; vertical-align: 0.5pt">1-7-1 Numéro d'autorisation d'ouverture
                    </span>
                </p>


                <p style="margin-top: 7.15pt">
                    <span style="font-family: Helvetica; ">1-7-2-1. <?php echo e($etablissements->libelleenseignement, false); ?> :
                        <b> <?php echo e($etablissements->numautorisationouverture ?? 'Non renseigné', false); ?> </b> </span>
                </p>
            </div>

            <div>
                <h3>Filières enseignées</h3>

                <?php if($nbre_filiere_enseignes > 0): ?>
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
                        <?php $__currentLoopData = $filiere_enseignes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filiere_enseigne): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration ?? '', false); ?></td>
                            <td><?php echo e($filiere_enseigne->libellefiliere ?? '', false); ?></td>
                            <td><?php echo e($filiere_enseigne->filnumaut ?? '', false); ?></td>
                            <td><?php echo e($filiere_enseigne->dureeformation ?? '', false); ?></td>
                            <td><?php echo e($filiere_enseigne->libellediplome ?? '', false); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php else: ?>
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
                <?php endif; ?>

                <br><br>
                <p>
                    <span style="font-family: Helvetica; font-weight: bold">Les personnels</span>
                </p>


                <?php if($nbre_personnels > 0): ?>
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
                        <?php $__currentLoopData = $personnels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personnel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr style="text-align: center">
                            <td><?php echo e($loop->iteration, false); ?></td>
                            <td><?php echo e($personnel->nom . ' ' . $personnel->prenoms ?? '', false); ?></td>
                            <td><?php echo e($personnel->matricule ?? '', false); ?></td>
                            <td><?php echo e($personnel->sexe ?? '', false); ?></td>
                            <td><?php echo e($personnel->libelletypepersonnel ?? '', false); ?></td>
                            <td><?php echo e($personnel->datenaissance ?? '', false); ?></td>
                            <td><?php echo e($personnel->lieunaissance ?? '', false); ?></td>
                            <td><?php echo e($personnel->pemail ?? '', false); ?></td>
                            <td><?php echo e($personnel->tel ?? '', false); ?></td>
                            <td><?php echo e($personnel->libellediplome ?? '', false); ?></td>
                            
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php else: ?>
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
                <?php endif; ?>

                <br><br>
                <p>
                    <span style="font-family: Helvetica; font-weight: bold">Besoin en personnel administratif</span>
                </p>

                <?php if($nbre_besoinpersonnel_admins > 0): ?>
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

                        <?php $__currentLoopData = $besoinpersonnel_admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $besoinpersonnel_admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="height: 35px;"><?php echo e($loop->iteration, false); ?></td>
                            <td><?php echo e($besoinpersonnel_admin->libellefonction ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($besoinpersonnel_admin->libelletypepersonnel ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($besoinpersonnel_admin->nombre ?? 'Non renseigné', false); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php else: ?>
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
                <?php endif; ?>


                <br><br>

                <p>
                    <span style="font-family: Helvetica; font-weight: bold">Besoin en personnel enseignant</span>
                </p>

                <?php if($nbre_besoinpersonnelens > 0): ?>
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

                        <?php $__currentLoopData = $besoinpersonnelens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $besoinpersonnelen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="height: 35px;"><?php echo e($loop->iteration, false); ?></td>
                            <td><?php echo e($besoinpersonnelen->libelleniveau ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($besoinpersonnelen->libellediscipline ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($besoinpersonnelen->nombre ?? 'Non renseigné', false); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php else: ?>
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
                <?php endif; ?>

                <br><br>
                <p>
                    <span style="font-family: Helvetica; font-weight: bold">Les classes</span>
                </p>

                <?php if($nbre_classes > 0): ?>
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

                        <?php $__currentLoopData = $boursiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $boursier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr style="text-align: center">
                            <td style="height: 35px;"><?php echo e($loop->iteration, false); ?></td>
                            <td><?php echo e($boursier->denominationclasse ?? '', false); ?></td>
                            <td><?php echo e($boursier->effectif_total ?? '', false); ?></td>
                            <td><?php echo e($boursier->effectif_gar ?? '', false); ?></td>
                            <td><?php echo e($boursier->effectif_fil ?? '', false); ?></td>
                            <td><?php echo e($boursier->nombre_boursiers ?? '', false); ?></td>
                            <td><?php echo e($boursier->nombre_non_boursiers ?? '', false); ?></td>
                            <td><?php echo e($boursier->nombre_affectes ?? '', false); ?></td>
                            <td><?php echo e($boursier->nombre_non_affectes ?? '', false); ?></td>
                            <td><?php echo e($boursier->libellegp ?? '', false); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
                <?php else: ?>
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
                <?php endif; ?>


                <br><br>
                <p>
                    <span style="font-family: Helvetica; font-weight: bold">Les apprenants</span>
                </p>

                <?php if($nbre_apprenants > 0): ?>
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
                        <?php $__currentLoopData = $apprenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classe => $eleves): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <tr style="background-color: #f0f0f0; font-weight: bold;">
                            <td colspan="10" style="text-align: left; padding-left: 10px; font-size: 16px !important;">
                                Classe : <?php echo e($classe, false); ?>

                            </td>
                        </tr>
                        <?php $__currentLoopData = $eleves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $apprenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr style="text-align: center">
                            <td style="height: 35px;"><?php echo e($index + 1, false); ?></td>
                            <td><?php echo e($apprenant->matriculeap ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($apprenant->nom . ' ' . $apprenant->prenoms ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($apprenant->datenaissance, false); ?></td>
                            <td><?php echo e($apprenant->lieunaissance ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($apprenant->sexe ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($apprenant->nationalite ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($apprenant->la_classe ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($apprenant->libelle_handicap ?? 'Sans handicap', false); ?></td>
                            <td><?php echo e($apprenant->moyenne2eme ?? '', false); ?></td>
                            <td><?php echo e($apprenant->moyenneannee ?? '', false); ?></td>
                            <td><?php echo e($apprenant->libelledecision ?? '', false); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php else: ?>
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
                <?php endif; ?>

                <br><br>
                <p>
                    <span style="font-family: Helvetica; font-weight: bold">Résulats aux examens</span>
                </p>

                <?php if($nbre_resultatexamens > 0): ?>
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
                        <?php $__currentLoopData = $resultatexamens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resultatexamen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="height: 35px;"><?php echo e($loop->iteration, false); ?></td>
                            <td><?php echo e($resultatexamen->libellediplome ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($resultatexamen->libellefiliere ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($resultatexamen->nombrecandidat_f ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($resultatexamen->nombrecandidat_g ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($resultatexamen->nombrecandidat_t ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($resultatexamen->nombreadmis_f ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($resultatexamen->nombreadmis_g ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($resultatexamen->nombreadmis_t ?? 'Non renseigné', false); ?></td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php else: ?>
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
                <?php endif; ?>

                <br><br>
                <p>
                    <span style="font-family: Helvetica; font-weight: bold">Infrastructures et locaux</span>
                </p>

                <?php if($nbre_infrastructures > 0): ?>
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

                        <?php $__currentLoopData = $infrastructures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $infrastructure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="height: 35px;"><?php echo e($loop->iteration, false); ?></td>
                            <td><?php echo e($infrastructure->libelleinfrastructure ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($infrastructure->nombre ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($infrastructure->cap ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($infrastructure->nombrebureaux ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($infrastructure->nbrefonctionnel ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($infrastructure->nbrenonfonctionel ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($infrastructure->obs ?? 'Non renseigné', false); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php else: ?>
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
                <?php endif; ?>


                <br><br>
                <p>
                    <span style="font-family: Helvetica; font-weight: bold">Besoin en matériels et divers</span>
                </p>

                <?php if($nbre_besoinsenmateriels > 0): ?>
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

                        <?php $__currentLoopData = $besoinsenmateriels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $besoinsenmateriel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="height: 35px;"><?php echo e($loop->iteration, false); ?></td>
                            <td><?php echo e($besoinsenmateriel->quantite ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($besoinsenmateriel->libellemateriel ?? 'Non renseigné', false); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php else: ?>
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
                <?php endif; ?>

                <br><br>

                <p>
                    <span style="font-family: Helvetica; font-weight: bold">Les prévisions</span>
                </p>

                <?php if($nbre_previsions > 0): ?>
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed; font-size: 14px !important; text-align: center">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Contenu</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $__currentLoopData = $previsions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prevision): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="height: 35px;"><?php echo e($loop->iteration, false); ?></td>
                            <td><?php echo e($prevision->libelleprevision ?? 'Non renseigné', false); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php else: ?>
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
                <?php endif; ?>


                <br><br>
                <p>
                    <span style="font-family: Helvetica; font-weight: bold">Etat des difficultés de gestion et
                        suggestions</span>
                </p>

                <?php if($nbre_etatgestions > 0): ?>
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

                        <?php $__currentLoopData = $etatgestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etatgestion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="height: 35px;"><?php echo e($loop->iteration, false); ?></td>
                            <td><?php echo e($etatgestion->nature ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($etatgestion->difficultes ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($etatgestion->causes ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($etatgestion->suggestions ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($etatgestion->observations ?? 'Non renseigné', false); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php else: ?>
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
                <?php endif; ?>

                <br><br>
                <p>
                    <span style="font-family: Helvetica; font-weight: bold">Equipements</span>
                </p>

                

                <?php if($nbre_equipements > 0): ?>
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
                        <?php $__currentLoopData = $equipements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="height: 35px;"><?php echo e($loop->iteration, false); ?></td>
                            <td><?php echo e($equipement->libellemateriel ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($equipement->nombre ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($equipement->nbrefonctionnel ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($equipement->nbrenonfonctionel ?? 'Non renseigné', false); ?></td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php else: ?>
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
                <?php endif; ?>


                <br><br>
                <p>
                    <span style="font-family: Helvetica; font-weight: bold">Besoin en formation</span>
                </p>

                <?php if($nbre_besoins > 0): ?>
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
                        <?php $__currentLoopData = $besoins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $besoin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="height: 35px;"><?php echo e($loop->iteration, false); ?></td>
                            <td><?php echo e($besoin->typeautorisation ?? 'Non renseigné', false); ?></td>
                            <td><?php echo e($besoin->nombre ?? 'Non renseigné', false); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php else: ?>
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
                <?php endif; ?>


                <br><br>
                

                <p>
                    <span style="font-family: Helvetica; font-weight: bold">Conclusion</span>
                </p>

                <?php if($nbre_conclusions > 0): ?>
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed;font-size: 14px !important; text-align: center;">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Contenu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $conclusions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conclusion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="height: 35px;"><?php echo e($loop->iteration, false); ?></td>
                            <td><?php echo e($conclusion->libelleconclusion ?? 'Non renseigné', false); ?></td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php else: ?>
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
                <?php endif; ?>
            </div>
        </div>
</body>

</html><?php /**PATH C:\wamp64\www\dep_rapport\resources\views/etab_identificationsem2.blade.php ENDPATH**/ ?>