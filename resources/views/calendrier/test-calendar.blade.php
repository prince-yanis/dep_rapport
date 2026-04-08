<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Test FullCalendar v6</title>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/locales/fr.global.min.js'></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        #calendar {
            max-width: 1100px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <h1>Test FullCalendar v6.1.19</h1>
    <div id='calendar'></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'fr',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                events: [
                    {
                        title: 'Test Event',
                        start: new Date(),
                        backgroundColor: '#3788d8'
                    }
                ]
            });
            calendar.render();
        });
    </script>
</body>
</html>
