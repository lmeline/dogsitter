// Créez un fichier resources/js/fullcalendar.js
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');

    let calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        initialView: 'timeGridWeek',
        selectable: true,
        editable: true,
        events: "/prestations/calendar/getprestations",
        headerToolbar: {
            left: 'prev,next today', // Boutons de navigation
            center: 'title', // Titre du calendrier
            right: 'dayGridMonth,timeGridWeek,timeGridDay', // Boutons pour changer de vue
        },
        locale: 'fr',
        slotMinTime: '07:00:00', 
        slotMaxTime: '21:00:00',
    });

    calendar.render();
});
