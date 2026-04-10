<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta name="generator" content="Aspose.Words for .NET 24.8.0" />
    <title></title>
    <style type="text/css">
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
            font-size: 15pt;
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
            margin-top: 2px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
            text-align: center;
        }

        td {
            /* text-align: left; */
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50px;
            text-align: center;
            font-size: 12px;
            color: gray;
            border-top: 6px solid #2596be;
            padding: 10px 0;
        }

        .page-break {
            page-break-before: always;
        }

        @page {
            margin: 100px 50px;
        }
    </style>
</head>

<body>
    <div style="font-weight: bold; margin-top: 65px">
        <p class="ListParagraph"
            style="margin-top: 1.8pt; margin-left: 18.3pt; font-family: Helvetica; font-size: 20px !important">
            ETABLISSEMENT : {{$etablissements->denominationetab ??  'Non renseigné' }}
        </p>
        <br>
        <p class="ListParagraph"
            style="margin-top: 1.8pt; margin-left: 18.3pt; font-family: Helvetica; font-size: 20px !important">
            DATE DE VISITE :{{ Carbon\Carbon::parse($etablissements->date_visite)->isoFormat('DD MMMM YYYY') ?? 'Non renseigné' }}
        </p>
        <br>
        <p class="ListParagraph"
            style="margin-top: 1.8pt; margin-left: 18.3pt; font-family: Helvetica; font-size: 20px !important">
            ORDRE D’ENSEIGNEMENT : {{$etablissements->libelleenseignement ?? 'Non renseigné' }}
        </p>
        <br>
        <br>
        <br>

        <h3
            style="padding:20px 30px; margin: 5px 260px; border: 4px solid #2596be; font-weight: bold; text-align: center; font-size: 20px !important">
            OBSERVATIONS ET RECOMMANDATIONS </h3>

        <br>
        <br>
    </div>

    <div>
        <table cellspacing="0" border="1" cellpadding="0"
            style="text-align: center !important; font-size: 15px !important">
            <tr>
                <th>N°</th>
                <th>RUBRIQUES</th>
                <th>OBSERVATIONS</th>
                <th>RECOMMANDATIONS</th>
                <th>DATE D’EXECUTION</th>
            </tr>

            @foreach ($resultatmissions as $resultatmission)
                <tr style="text-align: center !important">
                    <td>{{ $loop->iteration ?? 'Non renseigné' }}</td>
                    <td style="font-weight: bolder">{{ $resultatmission->libellerubrique ?? 'Non renseigné' }}</td>
                    <td>{{ $resultatmission->observation ?? 'Non renseigné' }}</td>
                    <td>{{ $resultatmission->recommandation ?? 'Non renseigné' }}</td>
                    <td>{{ $resultatmission->periode_execution ?? 'Non renseigné' }}
                    </td>
                </tr>
            @endforeach

        </table>
    </div>

    <br><br>

    <p style="font-size: 20px"><span style="margin-right: 300px">Directeur des Etudes</span> <span style="margin-left: 250px">Chef de Mission</span></p>

    <div class="footer">
        &copy; METFPA / DEP <span style="margin-left: 500px">MISSION DE SUIVI ET D'EVALUATION {{$etablissements->libelleanneescolaire ??  ' ' }}</span>
    </div>

</body>

</html>
