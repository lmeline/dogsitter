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

