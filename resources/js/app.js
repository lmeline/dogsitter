import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import { Calendar } from '@fullcalendar/core'; // Import de FullCalendar
import dayGridPlugin from '@fullcalendar/daygrid'; // Vue "Mois"
import timeGridPlugin from '@fullcalendar/timegrid'; // Vue "Semaine" et "Jour"
import interactionPlugin from '@fullcalendar/interaction'; // Interaction (drag-and-drop)
import frLocale from '@fullcalendar/core/locales/fr';

window.FullCalendar = {
    Calendar,
    plugins: {
        dayGrid: dayGridPlugin,
        timeGrid: timeGridPlugin,
        interaction: interactionPlugin,
        locale: frLocale,
    }
};

import flatpickr from "flatpickr";
import { French } from "flatpickr/dist/l10n/fr.js";


document.addEventListener('DOMContentLoaded', function () {
    flatpickr(".flatpickr", {
        locale: French,
        dateFormat: "d/m/Y",
        enableTime: true,
        time_24hr: true,
    });
});
