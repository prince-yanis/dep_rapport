<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
        rel="stylesheet">
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css' />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rrule/2.6.4/rrule.min.js"></script>

    <style>
        .modal {
            z-index: 1050 !important;
        }

        .modal-backdrop {
            z-index: 0 !important;
        }
        
        #calendar {
            max-width: 1200px;
            margin: 0 auto;
            /* background-color: white !important; */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 10px;
        }
        
        .fc {
            background-color: white !important;
        }
        
        .fc-daygrid-day {
            /* background-color: white !important; */
        }
        
        .fc-timegrid-slot {
            /* background-color: white !important; */
        }
        
        /* Styles pour les filtres */
        .filter-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .filter-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .filter-title::before {
            content: "🔍";
            margin-right: 8px;
        }
        
        .filter-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: end;
        }
        
        .filter-group {
            flex: 1;
            min-width: 200px;
        }
        
        .filter-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
            font-size: 14px;
        }
        
        .filter-group .form-control {
            width: 100%;
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 8px 12px;
            transition: border-color 0.3s ease;
        }
        
        .filter-group .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
        }
        
        .filter-actions {
            display: flex;
            gap: 10px;
            align-items: end;
        }
        
        .btn-filter {
            background: #007bff;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: 500;
        }
        
        .btn-filter:hover {
            background: #0056b3;
        }
        
        .btn-reset {
            background: #6c757d;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: 500;
        }
        
        .btn-reset:hover {
            background: #545b62;
        }
        
        /* Styles pour les boutons d'action */
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin: 15px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .btn-action {
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-action-primary {
            background: #28a745;
            color: white;
        }
        
        .btn-action-primary:hover {
            background: #218838;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
        }
        
        .btn-action-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-action-secondary:hover {
            background: #5a6268;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
        }
        
        @media (max-width: 768px) {
            .filter-row {
                flex-direction: column;
            }
            
            .filter-group {
                min-width: 100%;
            }
            
            .filter-actions {
                width: 100%;
                justify-content: stretch;
            }
            
            .btn-filter, .btn-reset {
                flex: 1;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: stretch;
            }
            
            .btn-action {
                width: 100%;
                justify-content: center;
            }
        }
        
        /* Styles pour l'impression */
        @media print {
            body * {
                visibility: hidden;
            }
            
            #calendar, #calendar * {
                visibility: visible;
            }
            
            #calendar {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: auto;
                max-width: none;
                margin: 0;
                padding: 20px;
                box-shadow: none;
                border: none;
            }
            
            .fc-toolbar, .fc-toolbar * {
                visibility: visible;
            }
            
            .fc-header-toolbar, .fc-footer-toolbar {
                display: block !important;
            }
            
            .fc-daygrid-day, .fc-timegrid-slot {
                background: white !important;
                border: 1px solid #ddd !important;
            }
            
            .fc-event {
                background: #007bff !important;
                color: white !important;
                border: none !important;
                font-size: 10px !important;
                padding: 2px 4px !important;
            }
            
            .fc-event-title {
                font-weight: bold !important;
            }
            
            /* Masquer les éléments non nécessaires */
            .filter-section,
            .btn,
            .modal,
            .datepicker,
            .print,
            .classes {
                display: none !important;
            }
            
            /* Titre pour l'impression */
            body:before {
                content: "EMPLOI DU TEMPS";
                position: absolute;
                top: 10px;
                left: 0;
                width: 100%;
                text-align: center;
                font-size: 18px;
                font-weight: bold;
                visibility: visible;
            }
            
            /* Date actuelle */
            body:after {
                content: "Imprimé le: " attr(data-print-date);
                position: absolute;
                bottom: 10px;
                right: 20px;
                font-size: 12px;
                visibility: visible;
            }
            
            /* Assurer que le calendrier prend toute la page */
            @page {
                margin: 1cm;
                size: landscape;
            }
        }
    </style>
</head>

<body>

    <!--<h2>
        <font color="deeppink">Planning des activités</font>
    </h2>-->
    <button type="button" id="print" class="btn btn-danger" style="display: none;">Print</button>
    
    <!-- Filtrage par critères -->
    <div class="filter-section">
        <div class="filter-title">Filtrer l'emploi du temps</div>
        <div class="filter-row">
            <div class="filter-group">
                <label for="etablissementFilter">Établissement</label>
                {!! Form::select('etablissementannees_id', $etablissements, $etablissement_id ?? null, [
                    'autocomplete' => 'off',
                    'placeholder' => 'Tous les établissements',
                    'class' => 'form-control',
                    'id' => 'etablissementFilter',
                ]) !!}
            </div>

            <div class="filter-group">
                <label for="professeurFilter">Professeur</label>
                {!! Form::select('personnels_id', $professeurs, null, [
                    'autocomplete' => 'off',
                    'placeholder' => 'Tous les professeurs',
                    'class' => 'form-control',
                    'id' => 'professeurFilter',
                ]) !!}
            </div>

            <div class="filter-group">
                <label for="classeFilter">Classe</label>
                {!! Form::select('classes_id', $classes, null, [
                    'autocomplete' => 'off',
                    'placeholder' => 'Toutes les classes',
                    'class' => 'form-control',
                    'id' => 'classeFilter',
                ]) !!}
            </div>

            <div class="filter-group">
                <label for="disciplineFilter">Discipline</label>
                {!! Form::select('disciplines_id', $disciplines, null, [
                    'autocomplete' => 'off',
                    'placeholder' => 'Toutes les disciplines',
                    'class' => 'form-control',
                    'id' => 'disciplineFilter',
                ]) !!}
            </div>

            <div class="filter-actions">
                <button id="filterButton" class="btn-filter">Filtrer</button>
                <button id="resetButton" class="btn-reset">Réinitialiser</button>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="action-buttons">
        <button type="button" id="classes" class="btn-action btn-action-primary">
            <span>→</span> Suivant
        </button>
    </div>


    <br />

    <div id='wrap'>
        <div id='calendar'></div>
        <div id='datepicker'></div>
        <div style='clear:both'></div>
    </div>
    <div id="createEventModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        <span class="sr-only">close</span></button>
                    <h4>Ajouter un cours</h4>
                </div>
                <form id="createEventForm" method="POST">
                    <input type="hidden" name="event_id" id="event_id" value="" />
                    <input type="hidden" name="planning_id" id="planning_id" value="" />
                    <div id="modalBody" class="modal-body">
                        <!--<div class="form-group">
                        <input class="form-control" type="text" placeholder="Event Name" id="eventName">
                    </div>-->
                        <div class="form-group">
                            {!! Form::select('etablissementannees_id', $etablissements, $etablissement_id ?? null, [
                                'autocomplete' => 'off',
                                'placeholder' => 'Etablissement',
                                'class' => 'form-control',
                                'id' => 'etablissement',
                                'required',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::select('personnels_id', $professeurs, null, [
                                'autocomplete' => 'off',
                                'placeholder' => 'Professeur',
                                'class' => 'form-control',
                                'id' => 'professeur',
                                'required',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::select('classes_id', $classes, null, [
                                'autocomplete' => 'off',
                                'placeholder' => 'Classe',
                                'class' => 'form-control',
                                'id' => 'classe',
                                'required',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::select('disciplines_id', $disciplines, null, [
                                'autocomplete' => 'off',
                                'placeholder' => 'Discipline',
                                'class' => 'form-control',
                                'id' => 'discipline',
                                'required',
                            ]) !!}
                        </div>

                        <div class="form-group ">
                            {!! Form::label('datedebut', 'Date de début') !!}
                            <div class="row">
                                <div class="col-md-6">
                                    {!! Form::input('date', 'datedebut_date', null, [
                                        'autocomplete' => 'off',
                                        'class' => 'form-control',
                                        'id' => 'datedebut_date',
                                        'placeholder' => 'JJ/MM/AAAA',
                                        'required' => true
                                    ]) !!}
                                </div>
                                <div class="col-md-6">
                                    {!! Form::input('time', 'datedebut_time', null, [
                                        'autocomplete' => 'off',
                                        'class' => 'form-control',
                                        'id' => 'datedebut_time',
                                        'placeholder' => 'HH:MM',
                                        'required' => true
                                    ]) !!}
                                </div>
                            </div>
                            <input type="hidden" id="datedebut" name="datedebut">
                        </div>
                        
                        <div class="form-group ">
                            {!! Form::label('datefin', 'Date de fin') !!}
                            <div class="row">
                                <div class="col-md-6">
                                    {!! Form::input('date', 'datefin_date', null, [
                                        'autocomplete' => 'off',
                                        'class' => 'form-control',
                                        'id' => 'datefin_date',
                                        'placeholder' => 'JJ/MM/AAAA',
                                        'required' => true
                                    ]) !!}
                                </div>
                                <div class="col-md-6">
                                    {!! Form::input('time', 'datefin_time', null, [
                                        'autocomplete' => 'off',
                                        'class' => 'form-control',
                                        'id' => 'datefin_time',
                                        'placeholder' => 'HH:MM',
                                        'required' => true
                                    ]) !!}
                                </div>
                            </div>
                            <input type="hidden" id="datefin" name="datefin">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="submitButton">Enregistrer</button>
                        <button type="button" class="btn btn-danger" id="deleteButton">Supprimer</button>
                        <button type="button" class="btn btn-danger" id="deleteAllButton">Supprimer Tout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/locales/fr.global.min.js'></script>
    <script
        src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js'>
    </script>

    <script>
        // Function to combine date and time inputs into datetime-local format
            function combineDateTime(dateId, timeId, targetId) {
                var date = $('#' + dateId).val();
                var time = $('#' + timeId).val();
                if (date && time) {
                    $('#' + targetId).val(date + 'T' + time);
                }
            }
            
            // Function to validate date is within current week
            function isDateInCurrentWeek(dateStr) {
                var selectedDate = new Date(dateStr);
                var today = new Date();
                var currentDay = today.getDay();
                var diff = today.getDate() - currentDay + (currentDay === 0 ? -6 : 1); // Start from Monday
                var monday = new Date(today.setDate(diff));
                var sunday = new Date(monday);
                sunday.setDate(monday.getDate() + 6);
                
                return selectedDate >= monday && selectedDate <= sunday;
            }
            
            // Update datetime when date or time changes
            $('#datedebut_date, #datedebut_time').on('change', function() {
                combineDateTime('datedebut_date', 'datedebut_time', 'datedebut');
            });
            
            $('#datefin_date, #datefin_time').on('change', function() {
                combineDateTime('datefin_date', 'datefin_time', 'datefin');
            });
            
            // Function to split datetime-local into separate date and time inputs
            function splitDateTime(datetimeId, dateId, timeId) {
                var datetime = $('#' + datetimeId).val();
                if (datetime) {
                    var parts = datetime.split('T');
                    $('#' + dateId).val(parts[0] || '');
                    $('#' + timeId).val(parts[1] || '');
                }
            }
            
            // Helper function pour formater les dates en datetime-local
            function formatDateTimeLocal(date) {
                var year = date.getFullYear();
                var month = String(date.getMonth() + 1).padStart(2, '0');
                var day = String(date.getDate()).padStart(2, '0');
                var hours = String(date.getHours()).padStart(2, '0');
                var minutes = String(date.getMinutes()).padStart(2, '0');
                return year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;
            }
        
        // Déclarer calendar globalement pour y accéder depuis toutes les fonctions
        var calendar;
        
        $(document).ready(function() {
            // Récupérer les paramètres de l'URL pour pré-remplir les filtres
            var urlParams = new URLSearchParams(window.location.search);
            
            // Pré-remplir les filtres avec les paramètres URL
            if (urlParams.has('etablissementannees_id')) {
                $('#etablissementFilter').val(urlParams.get('etablissementannees_id'));
            }
            if (urlParams.has('personnels_id')) {
                $('#professeurFilter').val(urlParams.get('personnels_id'));
            }
            if (urlParams.has('classes_id')) {
                $('#classeFilter').val(urlParams.get('classes_id'));
            }
            if (urlParams.has('disciplines_id')) {
                $('#disciplineFilter').val(urlParams.get('disciplines_id'));
            }
            
            //$(".printBtn").on("click", function (){
            $("#print").on("click", function() {
                window.print();
            });

            $("#classes").on("click", function() {
               // location.href = "/admin/apprenantannees";
				location.href = "/admin/apprenantannees_1er";
            });
            // Initialiser DateTimePicker en 24h sur les champs de date
            // $("#datedebut, #datefin").datetimepicker({
            //     locale: 'fr',
            //     // Définir la langue en français
            //     format: 'DD-MM-YYYY HH:mm',
            // })
            // Attendre que tous les scripts soient chargés avant d'initialiser FullCalendar
            setTimeout(function() {
                try {
                    var calendarEl = document.getElementById('calendar');
                    if (!calendarEl) {
                        console.error('Élément #calendar non trouvé');
                        return;
                    }
                    
                    calendar = new FullCalendar.Calendar(calendarEl, {
                        locale: 'fr',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                        },
                        buttonText: {
                            today: "Aujourd'hui",
                            dayGridMonth: "Mois",
                            timeGridWeek: "Semaine", 
                            timeGridDay: "Jour",
                            listWeek: "Liste"
                        },
                        initialView: 'timeGridWeek', // Vue semaine par défaut
                        editable: true,
                        selectable: true,
                        selectMirror: true,
                        height: 'auto',
                        
                        // Masquer uniquement le dimanche (certains établissements ont cours le samedi)
                        hiddenDays: [0], // 0 = Dimanche
                        
                        // Limiter l'affichage aux heures de 7h00 à 20h00
                        slotMinTime: '07:00',
                        slotMaxTime: '20:00',
                        
                        // Contrainte des heures de 7h00 à 20h00 (lundi-samedi)
                        businessHours: {
                            daysOfWeek: [1, 2, 3, 4, 5, 6], // Lundi - Samedi
                            startTime: '07:00',
                            endTime: '20:00'
                        },
                        
                        // Limiter la création d'événements aux heures de travail
                        selectConstraint: 'businessHours',
                        
                        // Charger les événements depuis le backend Laravel avec les filtres de l'URL
                        events: function(fetchInfo, successCallback, failureCallback) {
                            var baseUrl = '{{ url('admin/getFilteredEvents') }}';
                            var urlParams = new URLSearchParams(window.location.search);
                            var filterParams = {};
                            
                            if (urlParams.has('etablissementannees_id')) filterParams.etablissementannees_id = urlParams.get('etablissementannees_id');
                            if (urlParams.has('personnels_id')) filterParams.personnels_id = urlParams.get('personnels_id');
                            if (urlParams.has('classes_id')) filterParams.classes_id = urlParams.get('classes_id');
                            if (urlParams.has('disciplines_id')) filterParams.disciplines_id = urlParams.get('disciplines_id');
                            
                            var queryString = $.param(filterParams);
                            var fullUrl = queryString ? baseUrl + '?' + queryString : baseUrl;
                            
                            $.ajax({
                                url: fullUrl,
                                type: 'GET',
                                success: function(events) {
                                    // Vérifier si le calendrier est vide
                                    var hasEvents = events && events.length > 0;
                                    
                                    if (!hasEvents) {
                                        // Afficher un message dans le calendrier vide
                                        successCallback([]);
                                        
                                        // Ajouter un message dans le calendrier après le rendu
                                        setTimeout(function() {
                                            var calendarEl = document.getElementById('calendar');
                                            if (calendarEl && !calendarEl.querySelector('.no-data-message')) {
                                                var messageDiv = document.createElement('div');
                                                messageDiv.className = 'no-data-message';
                                                messageDiv.innerHTML = '📋 Aucune donnée<br><small>Veuillez sélectionner des critères pour afficher les événements</small>';
                                                messageDiv.style.cssText = `
                                                    position: absolute;
                                                    top: 50%;
                                                    left: 50%;
                                                    transform: translate(-50%, -50%);
                                                    text-align: center;
                                                    color: #6c757d;
                                                    font-size: 18px;
                                                    font-weight: 500;
                                                    z-index: 10;
                                                    pointer-events: none;
                                                    background: rgba(255, 255, 255, 0.9);
                                                    padding: 20px;
                                                    border-radius: 8px;
                                                    border: 2px dashed #dee2e6;
                                                    min-width: 300px;
                                                `;
                                                calendarEl.appendChild(messageDiv);
                                            }
                                        }, 100);
                                    } else {
                                        // Supprimer le message s'il existe
                                        setTimeout(function() {
                                            var messageEl = document.querySelector('.no-data-message');
                                            if (messageEl) {
                                                messageEl.remove();
                                            }
                                        }, 100);
                                        successCallback(events);
                                    }
                                },
                                error: function() {
                                    failureCallback();
                                }
                            });
                        },
                        eventClick: function(info) {
                            // Afficher les détails de l'événement dans le modal
                            var event = info.event;
                            $('#event_id').val(event.id);
                            $('#planning_id').val(event.id);
                            
                            // Pré-remplir le formulaire avec les données de l'événement
                            $('#etablissement').val(event.extendedProps.letablissement);
                            $('#professeur').val(event.extendedProps.leprofesseur);
                            $('#classe').val(event.extendedProps.laclasse);
                            $('#discipline').val(event.extendedProps.ladiscipline);
                            
                            // Pré-remplir les dates avec les données de l'événement
                            var startDate = new Date(event.start);
                            var endDate = new Date(event.end);
                            
                            $('#datedebut').val(formatDateTimeLocal(startDate));
                            $('#datefin').val(formatDateTimeLocal(endDate));
                            
                            // Split into separate inputs
                            splitDateTime('datedebut', 'datedebut_date', 'datedebut_time');
                            splitDateTime('datefin', 'datefin_date', 'datefin_time');
                            
                            $('#createEventModal').modal('show');
                        },
                        dateClick: function(info) {
                            // Créer un nouvel événement au clic sur une date
                            $('#event_id').val('');
                            $('#planning_id').val('0');
                            
                            // Réinitialiser le formulaire
                            $('#etablissement').val('');
                            $('#professeur').val('');
                            $('#classe').val('');
                            $('#discipline').val('');
                            
                            // Pré-remplir les dates avec le jour cliqué
                            var clickDate = new Date(info.date);
                            clickDate.setHours(8, 0, 0, 0); // 8:00 AM par défaut (dans les heures de travail)
                            var endTime = new Date(clickDate);
                            endTime.setHours(9, 0, 0, 0); // 9:00 AM par défaut
                            
                            $('#datedebut').val(formatDateTimeLocal(clickDate));
                            $('#datefin').val(formatDateTimeLocal(endTime));
                            
                            // Split into separate inputs
                            splitDateTime('datedebut', 'datedebut_date', 'datedebut_time');
                            splitDateTime('datefin', 'datefin_date', 'datefin_time');
                            
                            $('#createEventModal').modal('show');
                        },
                        select: function(info) {
                            // Gérer la sélection multiple de créneaux horaires
                            $('#event_id').val('');
                            $('#planning_id').val('0');
                            
                            // Réinitialiser le formulaire
                            $('#etablissement').val('');
                            $('#professeur').val('');
                            $('#classe').val('');
                            $('#discipline').val('');
                            
                            // Utiliser les dates de sélection
                            $('#datedebut').val(formatDateTimeLocal(info.start));
                            $('#datefin').val(formatDateTimeLocal(info.end));
                            
                            // Split into separate inputs
                            splitDateTime('datedebut', 'datedebut_date', 'datedebut_time');
                            splitDateTime('datefin', 'datefin_date', 'datefin_time');
                            
                            $('#createEventModal').modal('show');
                            
                            // Désélectionner après avoir ouvert le modal
                            calendar.unselect();
                        }
                    });
                    
                    calendar.render();
                    console.log('FullCalendar initialisé avec succès - Version simplifiée');
                    
                } catch (error) {
                    console.error('Erreur lors de l\'initialisation de FullCalendar:', error);
                    // Afficher un message d'erreur à l'utilisateur
                    var calendarEl = document.getElementById('calendar');
                    if (calendarEl) {
                        calendarEl.innerHTML = '<div class="alert alert-warning">Le calendrier ne peut pas être chargé. Erreur: ' + error.message + '</div>';
                    }
                }
            }, 1000); // Attendre 1 seconde

            // Filtrer les événements au clic sur le bouton Filtrer///////////////////////////////
            $('#filterButton').on('click', function() {
                // Construire l'URL avec les paramètres de filtre
                var etablissementannees_id = $('#etablissementFilter').val();
                var personnels_id = $('#professeurFilter').val();
                var classes_id = $('#classeFilter').val();
                var disciplines_id = $('#disciplineFilter').val();
                
                var filterParams = {};
                if (etablissementannees_id) filterParams.etablissementannees_id = etablissementannees_id;
                if (personnels_id) filterParams.personnels_id = personnels_id;
                if (classes_id) filterParams.classes_id = classes_id;
                if (disciplines_id) filterParams.disciplines_id = disciplines_id;
                
                // Recharger la page avec les paramètres de filtre
                var currentUrl = window.location.pathname;
                var queryString = $.param(filterParams);
                var filterUrl = queryString ? currentUrl + '?' + queryString : currentUrl;
                
                window.location.href = filterUrl;
                console.log('Filtres appliqués:', filterParams);
            });

            // Réinitialiser les filtres au clic sur le bouton Réinitialiser
            $('#resetButton').on('click', function() {
                // Réinitialiser tous les champs de filtre
                $('#etablissementFilter').val('');
                $('#professeurFilter').val('');
                $('#classeFilter').val('');
                $('#disciplineFilter').val('');
                
                // Recharger la page sans paramètres de filtre
                window.location.href = window.location.pathname;
                console.log('Filtres réinitialisés');
            });

            // Fonction pour récupérer les événements filtrés via AJAX/////////////////////////////////
            function fetchFilteredEvents(successCallback) {
                var etablissementannees_id = $('#etablissementFilter').val();
                var personnels_id = $('#professeurFilter').val();
                var classes_id = $('#classeFilter').val();
                var disciplines_id = $('#disciplineFilter').val();

                $.ajax({
                    url: '{{ url('admin/getFilteredEvents') }}',
                    type: 'GET',
                    data: {
                        etablissementannees_id: etablissementannees_id,
                        personnels_id: personnels_id,
                        classes_id: classes_id,
                        disciplines_id: disciplines_id,
                    },
                    success: function(events) {
                        // Appel de la fonction callback pour mettre à jour les événements
                        successCallback(events);
                    },
                    error: function() {
                        failureCallback('Erreur lors du chargement des événements.');
                    }
                });
            }

            ////////////////////////////////////////////////////////////////////////
            // DateTimePicker pour la sélection des dates
            $("#datedebut, #datefin").datetimepicker();

            // Soumettre le formulaire et mettre à jour l'événement
            $('#createEventForm').submit(function(e) {
                e.preventDefault();
                
                var data = {
                    _token: '{{ csrf_token() }}',
                    id: $('#planning_id').val(),
                    datedebut: $('#datedebut').val(),
                    datefin: $('#datefin').val(),
                    personnels_id: $('#professeur').val(),
                    classes_id: $('#classe').val(),
                    disciplines_id: $('#discipline').val(),
                    etablissementannees_id: $('#etablissement').val()
                };
                
                // Debug: afficher les données envoyées
                console.log('Données envoyées:', data);
                
                $('#createEventModal').modal('hide');
                $.post('{{ url('admin/miseajourplanning') }}', data, function(response) {
                    // Debug: afficher la réponse du serveur
                    console.log('Réponse du serveur:', response);
                    
                    // Afficher un message de succès
                    alert('Événement créé avec succès !');
                    
                    // Recharger uniquement le calendrier pour afficher la nouvelle insertion
                    if (typeof calendar !== 'undefined' && calendar) {
                        console.log('Tentative de rafraîchissement du calendrier...');
                        try {
                            calendar.refetchEvents();
                            console.log('Calendrier rafraîchi avec succès');
                        } catch (error) {
                            console.error('Erreur lors du rafraîchissement:', error);
                            // Fallback: recharger la page si le calendrier n'est pas initialisé
                            location.reload();
                        }
                    } else {
                        console.log('Calendar non défini, rechargement de la page');
                        // Fallback: recharger la page si le calendrier n'est pas initialisé
                        location.reload();
                    }
                }).fail(function(xhr, status, error) {
                    // Debug: afficher l'erreur
                    console.error('Erreur AJAX:', xhr.responseText);
                    alert('Erreur lors de la création: ' + xhr.responseText);
                });
            });
            /**************************/
            $('#deleteButton').click(function(e) {
                e.preventDefault();
                $event_id = $('input[name=event_id]').val();
                // alert($event_id)
                $('#createEventModal').modal('hide');
                var data = {
                    _token: '{{ csrf_token() }}',
                    id: $('#planning_id').val(),
                    datedebut: $('#datedebut').val(),
                    datefin: $('#datefin').val(),
                    personnels_id: $('#professeur').val(),
                    classes_id: $('#classe').val(),
                    disciplines_id: $('#discipline').val(),
                    etablissementannees_id: $('#etablissement').val(),
                    all: 0,
                };
                // alert(JSON.stringify(data))
                $.post('{{ url('admin/supprimerplanning') }}', data, function(result) {
                    // Afficher un message de succès
                    alert('Événement supprimé avec succès !');
                    // Recharger uniquement le calendrier pour afficher les modifications
                    if (typeof calendar !== 'undefined') {
                        calendar.refetchEvents();
                    } else {
                        // Fallback: recharger la page si le calendrier n'est pas initialisé
                        location.reload();
                    }
                });
            });

            $('#deleteAllButton').click(function(e) {
                e.preventDefault();
                $event_id = $('input[name=event_id]').val();
                // alert($event_id)
                $('#createEventModal').modal('hide');
                var data = {
                    _token: '{{ csrf_token() }}',
                    id: $('#planning_id').val(),
                    datedebut: $('#datedebut').val(),
                    datefin: $('#datefin').val(),
                    personnels_id: $('#professeur').val(),
                    classes_id: $('#classe').val(),
                    disciplines_id: $('#discipline').val(),
                    etablissementannees_id: $('#etablissement').val(),
                    all: 1,
                };
                // alert(JSON.stringify(data))
                $.post('{{ url('admin/supprimerplanning') }}', data, function(result) {
                    // Afficher un message de succès
                    alert('Événement supprimé avec succès !');
                    // Recharger uniquement le calendrier pour afficher les modifications
                    if (typeof calendar !== 'undefined') {
                        calendar.refetchEvents();
                    } else {
                        // Fallback: recharger la page si le calendrier n'est pas initialisé
                        location.reload();
                    }
                });
            });
            // Configurer Moment.js en français
            // moment.locale('fr');
            /*************************/
        });
    </script>

</body>

</html>
