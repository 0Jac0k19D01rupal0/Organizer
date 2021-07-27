<script>
import { Calendar } from '@fullcalendar/core';
import '@fullcalendar/core/vdom' // solves problem with Vite
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

// let calendarEl = document.getElementById('calendar');
//
// let calendar = new Calendar(calendarEl, {
//     plugins: [ interactionPlugin ],
//     // ...
//         dateClick: function(info) {
//     alert('Clicked on: ' + info.dateStr);
//     alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
//     alert('Current view: ' + info.view.type);
//     // change the day's background color just for fun
//     info.dayEl.style.backgroundColor = 'red';
// }
// });

export default {
    components: {
        FullCalendar // make the <FullCalendar> tag available
    },
    data() {
        return {
            calendarOptions: {
                plugins: [ dayGridPlugin, interactionPlugin ],
                initialView: 'dayGridMonth'
            }
        }
    }
}
console.log('Works in vue')

</script>
<template>
    <FullCalendar :options="calendarOptions" />
</template>
