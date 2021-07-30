<script>

import FullCalendar from '@fullcalendar/vue'
import DayGridPlugin from '@fullcalendar/daygrid'
import TimeGridPlugin from '@fullcalendar/timegrid'
import InteractionPlugin from '@fullcalendar/interaction'
import ListPlugin from '@fullcalendar/list'

export default {

    data() {
        return {
            calendarOptions: {
                plugins: [ DayGridPlugin, InteractionPlugin, TimeGridPlugin, ListPlugin],
                initialView: 'dayGridMonth'
            }
        }
    },
    components: {
        FullCalendar // make the <FullCalendar> tag available
    }
}
</script>
<template>
    <FullCalendar
        :options="calendarOptions"
        :header="{
            left: '',
            center: 'today',
            right: ''
        }"
    />
</template>
