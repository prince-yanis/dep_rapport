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
                    <b><?php echo e($etablissements->denominationetab ?? 'Non renseigné', false); ?></b> &nbsp; &nbsp; &nbsp; Sigle:
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

            <p style="margin-top: 5.25pt">
                <span style="font-family: Helvetica; font-weight: bold">I-6. Localisation</span>
            </p>
            <p style="margin-top: 8pt">
                <span style="font-family: Helvetica">I-6-1. Direction régionale :
                    <b><?php echo e($etablissements->denominationdr ?? 'Non renseigné', false); ?> </b></span>
            </p>
            <p style="margin-top: 10pt">
                <span style="font-family: Helvetica">Départementale
                    : <b><?php echo e($etablissements->denominationdd ?? 'Non renseigné', false); ?></b> </span>
            </p>

            <p style="margin-top: 6.75pt">
                <span style="font-family: Helvetica; letter-spacing: -0.1pt">I-6-2. Commune:
                    <b><?php echo e($etablissements->denominationcommune ?? 'Non renseigné', false); ?></b>. &nbsp; &nbsp;&nbsp; &nbsp;
                    Ville: <b><?php echo e($etablissements->denominationdepartement ?? 'Non renseigné', false); ?></b></span>
            </p>
            <p style="margin-top: 6.75pt">
                <span style="font-family: Helvetica; letter-spacing: -0.1pt">I-6-3. Quartier :
                    <b> <?php echo e($etablissements->localisation ?? 'Non renseigné', false); ?> </b></span>
            </p>
        </div>

        <div class="page">
            <h3 class="section-title">1. PERSONNEL ENSEIGNANT</h3>
            
            <h4 style="font-weight: bold; margin-top: 20px;">1.1. Effectif du personnel enseignant</h4>
            
            <?php if($nbre_personnels > 0): ?>
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
                        <?php $__currentLoopData = $personnels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personnel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
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
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucune donnée existante.
                </p>
            <?php endif; ?>

            <h4 style="font-weight: bold; margin-top: 30px;">1.2. Conseils d'enseignement</h4>
            
            <?php if($conseilsEnseignement->count() > 0): ?>
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
                        <?php $__currentLoopData = $conseilsEnseignement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conseil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration, false); ?></td>
                                <td><?php echo e($conseil['nom'] . ' ' . $conseil['prenoms'], false); ?></td>
                                <td><?php echo e($conseil['discipline'], false); ?></td>
                                <td><?php echo e($conseil['telephone'], false); ?></td>
                                <td><?php echo e($conseil['email'], false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucun conseil d'enseignement enregistré.
                </p>
            <?php endif; ?>

            <h4 style="font-weight: bold; margin-top: 30px;">1.3. Besoins en personnel enseignant</h4>
            
            <?php if($besoinpersonnelens->count() > 0): ?>
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
                        <?php $__currentLoopData = $besoinpersonnelens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $besoin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration, false); ?></td>
                                <td><?php echo e($besoin->libellediscipline ?? '', false); ?></td>
                                <td><?php echo e($besoin->libelleniveauenseignant ?? '', false); ?></td>
                                <td><?php echo e($besoin->nomberequis ?? '', false); ?></td>
                                <td><?php echo e($besoin->observation ?? '', false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucun besoin en personnel enregistré.
                </p>
            <?php endif; ?>
        </div>

        <div class="page">
            <h3 class="section-title">2. APPRENANTS</h3>
            
            <h4 style="font-weight: bold; margin-top: 20px;">2.1. Effectif des Apprenants par niveau et par classe</h4>
            
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
                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr style="text-align: center">
                                <td style="height: 35px;"><?php echo e($loop->iteration, false); ?></td>
                                <td><?php echo e($classe->denominationclasse ?? '', false); ?></td>
                                <td><?php echo e($classe->effectif_total ?? '', false); ?></td>
                                <td><?php echo e($classe->effectif_gar ?? '', false); ?></td>
                                <td><?php echo e($classe->effectif_fil ?? '', false); ?></td>
                                <td><?php echo e($classe->effectif_boursier ?? '', false); ?></td>
                                <td><?php echo e($classe->effectif_nonboursier ?? '', false); ?></td>
                                <td><?php echo e($classe->effectif_affecte ?? '', false); ?></td>
                                <td><?php echo e($classe->effectif_nonaffecte ?? '', false); ?></td>
                                <td><?php echo e($classe->libellegp ?? '', false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucune classe existante.
                </p>
            <?php endif; ?>

            <h4 style="font-weight: bold; margin-top: 30px;">2.2. Effectifs des Apprenants de 1ère année et de seconde en fonction du mode de recrutement</h4>
            
            <?php if($effectifsrecrutements->count() > 0): ?>
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
                        <?php $__currentLoopData = $effectifsrecrutements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recrutement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr style="text-align: center">
                                <td><?php echo e($loop->iteration, false); ?></td>
                                <td><?php echo e($recrutement->libellediplome ?? '', false); ?></td>
                                <td><?php echo e($recrutement->libellefiliere ?? '', false); ?></td>
                                <td><?php echo e($recrutement->moderecrutement ?? '', false); ?></td>
                                <td><?php echo e($recrutement->effectif ?? '', false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucune donnée de recrutement existante.
                </p>
            <?php endif; ?>

            <h4 style="font-weight: bold; margin-top: 30px;">2.3. Statut des Apprenants par filière et par niveau</h4>
            
            <?php if($statutsapprenants->count() > 0): ?>
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
                        <?php $__currentLoopData = $statutsapprenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statut): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr style="text-align: center">
                                <td><?php echo e($loop->iteration, false); ?></td>
                                <td><?php echo e($statut->libellediplome ?? '', false); ?></td>
                                <td><?php echo e($statut->libellefiliere ?? '', false); ?></td>
                                <td><?php echo e($statut->libelleniveau ?? '', false); ?></td>
                                <td><?php echo e($statut->nbreaffecte ?? '', false); ?></td>
                                <td><?php echo e($statut->nbrenonaffecte ?? '', false); ?></td>
                                <td><?php echo e($statut->nbreboursier ?? '', false); ?></td>
                                <td><?php echo e($statut->nbrenonboursier ?? '', false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucune donnée de statut existante.
                </p>
            <?php endif; ?>

            <h4 style="font-weight: bold; margin-top: 30px;">2.4. Récapitulatif général</h4>
            
            <?php if($recapGens->count() > 0): ?>
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
                        <?php $__currentLoopData = $recapGens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr style="text-align: center">
                                <td><?php echo e($loop->iteration, false); ?></td>
                                <td><?php echo e($recap->libelleniveau ?? '', false); ?></td>
                                <td><?php echo e($recap->effectif_total ?? '', false); ?></td>
                                <td><?php echo e($recap->effectif_gar ?? '', false); ?></td>
                                <td><?php echo e($recap->effectif_fil ?? '', false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucune donnée récapitulative existante.
                </p>
            <?php endif; ?>

            <h4 style="font-weight: bold; margin-top: 30px;">2.5. Cours du soir</h4>
            <p style="color: #ed7d31; font-style: italic; text-align: center">
                [Section à développer selon les données disponibles]
            </p>
        </div>

        <div class="page">
            <h3 class="section-title">3. POINT DE L'EXECUTION DES PROGRAMMES ET PROGRESSIONS</h3>
            
            <h4 style="font-weight: bold; margin-top: 20px;">3.1. Niveau d'exécution des programmes et progressions</h4>
            
            <?php if($pointexecutions->count() > 0): ?>
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
                        <?php $__currentLoopData = $pointexecutions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $execution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr style="text-align: center">
                                <td><?php echo e($loop->iteration, false); ?></td>
                                <td><?php echo e($execution->libellediscipline ?? '', false); ?></td>
                                <td><?php echo e($execution->niveauexecution ?? '', false); ?></td>
                                <td><?php echo e($execution->progression ?? '', false); ?></td>
                                <td><?php echo e($execution->observation ?? '', false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucune donnée d'exécution de programme existante.
                </p>
            <?php endif; ?>

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
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucune infrastructure existante.
                </p>
            <?php endif; ?>

            <h4 style="font-weight: bold; margin-top: 30px;">5.2. Clôture</h4>
            <p style="color: #ed7d31; font-style: italic; text-align: center">
                [Section à développer - État de la clôture]
            </p>

            <h4 style="font-weight: bold; margin-top: 30px;">5.3. Problèmes liés aux infrastructures</h4>
            
            <?php if($nbre_probleme > 0): ?>
                <table border="1" cellpadding="8" cellspacing="0"
                    style="width: 100%; table-layout: fixed; font-size: 14px !important; text-align: center">
                    <thead>
                        <tr>
                            <th style="width: 3%;">N°</th>
                            <th>Problème</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $probleme_urgents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $probleme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="height: 35px;"><?php echo e($loop->iteration, false); ?></td>
                                <td><?php echo e($probleme->libelleprobleme ?? 'Non renseigné', false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucun problème urgent signalé.
                </p>
            <?php endif; ?>
        </div>

        <div class="page">
            <h3 class="section-title">6. INVENTAIRE GENERAL DU MATERIEL ET DES EQUIPEMENTS</h3>
            
            <h4 style="font-weight: bold; margin-top: 20px;">6.1. Matériels</h4>
            
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
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucun équipement existant.
                </p>
            <?php endif; ?>

            <h4 style="font-weight: bold; margin-top: 30px;">6.2. Équipements</h4>
            <p style="color: #ed7d31; font-style: italic; text-align: center">
                [Section à développer - Autres équipements spécifiques]
            </p>
        </div>

        <div class="page">
            <h3 class="section-title">7. PROBLEMES URGENTS</h3>
            
            <?php if($nbre_probleme > 0): ?>
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
                        <?php $__currentLoopData = $probleme_urgents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $probleme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="height: 35px;"><?php echo e($loop->iteration, false); ?></td>
                                <td><?php echo e($probleme->libelleprobleme ?? 'Non renseigné', false); ?></td>
                                <td><?php echo e($probleme->degreurgence ?? 'Non spécifié', false); ?></td>
                                <td><?php echo e($probleme->solution ?? 'Non spécifiée', false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucun problème urgent signalé.
                </p>
            <?php endif; ?>
        </div>

        <div class="page">
            <h3 class="section-title">CONCLUSION</h3>
            
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
                <p style="color: #ed7d31; font-weight: bold; font-style: italic; text-align: center">
                    Aucune conclusion enregistrée.
                </p>
            <?php endif; ?>
        </div>

    </div>
</body>

</html>
<?php /**PATH C:\wamp64\www\dep_rapport\resources\views/etab_identificationsem1_restructured.blade.php ENDPATH**/ ?>