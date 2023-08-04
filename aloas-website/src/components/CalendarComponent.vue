<template>
  <div class="calendar">
    <FullCalendar :options="calendarOptions" />
    <div class="divider"></div>
  </div>
</template>

<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction' // needed for dayClick
import frLocale from '@fullcalendar/core/locales/fr'
import timeGridPlugin from '@fullcalendar/timegrid'

export default {
  components: {
    FullCalendar
  },
  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        initialView: 'timeGridWeek',
        contentHeight: 'auto',
        locale: frLocale,
        allDaySlot: false, // Remove "All-day" box
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'timeGridWeek,dayGridMonth'
        },
        buttonText: {
          today: 'Aujourd\'hui',
          month: 'Mois',
          week: 'Semaine',
          next : '>',
          prev : '<'
        },
        slotMinTime: '08:00:00',
        slotMaxTime: '22:00:00',
        slotDuration: '0:30:00',
        selectable: true // Allow selecting dates on the calendar
      },
      selectedDate: null
    }
  },
  methods: {
    handleSlotDblClick(arg){
      const newEvent = {
        title: 'Nouvel événement',
        start: arg.date,
        end: arg.date,
        allDay: false
      };
      this.calendarOptions.events = [...this.calendarOptions.events, newEvent];
    }
  }
}
</script>

<style>

</style>
