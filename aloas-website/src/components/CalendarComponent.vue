<template>
  <div class="calendar">
    <FullCalendar ref ="calendar" :options="calendarOptions" />
    <div class="divider"></div>
  </div>
</template>

<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction' // needed for dayClick
import frLocale from '@fullcalendar/core/locales/fr'
import timeGridPlugin from '@fullcalendar/timegrid'
import {mapState, mapActions} from 'vuex';

export default {
  components: {
    FullCalendar
  },
  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        contentHeight: 'auto',
        locale: frLocale,
        allDaySlot: false, // Remove "All-day" box
        dateClick : this.handleDateClick,
        eventClick: this.handleEventClick,
        events: [
          { title: 'event 1', start: '2023-09-01T08:00:00', end: '2023-09-01T10:00:00' },
          { title: 'event 2', start: '2023-09-01T10:00:00', end: '2023-09-01T14:00:00' }, // Event with specific times

        ],
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
        selectable: true,
      },
     
    }
  },
  methods: {
    handleDateClick : function (arg) {
      
    },
    handleEventClick : function (info){
      if(info.jsEvent.button === 0) {
        console.log("ok")
        const confirmation = window.confirm(`Voulez vous supprimez ${info.event.title} ?`);
        if(confirmation) {
          info.event.remove();
          alert("L'évenement à été supprimmé !");
        }
      }
      else if(info.view.type === 'dayGridMonth'){
        this.$refs.calendar.getApi().changeView('timeGridWeek','2023-09-01');
      }
    }
  }
}
</script>


