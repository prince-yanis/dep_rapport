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
                LES EMPLOIS DU TEMPS <br>
                <span style="font-family: Helvetica; letter-spacing: -0.1pt">
                    <b>Code: {{ $etablissements->code }} - {{ $etablissements->denominationetab ?? 'Non renseigné' }}</b> &nbsp; &nbsp; &nbsp; Sigle:
                    {{ $etablissements->sigle ?? ' ' }}
                </span>
            </h3>

        </div>

        <div>
            <br>
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
        </div>

    </div>
</body>

</html>
