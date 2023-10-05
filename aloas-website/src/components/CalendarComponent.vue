<template>
  <div class="calendar">
    <FullCalendar ref="calendar" :options="calendarOptions" />
  </div>
</template>

<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import frLocale from '@fullcalendar/core/locales/fr'
import timeGridPlugin from '@fullcalendar/timegrid'
import { mapState } from 'vuex';

export default {
  computed: {
    ...mapState(["user"]),
    dynamicHeaderToolbar() {
      if (this.user.is_admin) {
        return {
          left: 'prev,next today addEventButton',
          center: 'title',
          right: 'timeGridWeek,dayGridMonth'
        };
      } else {
        return {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth'
        };
      }
    },
  },
  watch: {
    dynamicHeaderToolbar: {
      handler(newToolbar) {
        this.$nextTick(() => {
          if (this.$refs.calendar) {
            this.calendarOptions.headerToolbar = newToolbar;
            const calendarApi = this.$refs.calendar.getApi();
            if (calendarApi) {
              calendarApi.setOption('headerToolbar', newToolbar);
            }
          }
        });
      },
      immediate: true, 
    },
  },
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
        allDaySlot: false,
        dateClick: this.handleDateClick,
        eventClick: this.handleEventClick,
        events: [],
        customButtons: {
          addEventButton: {
            text: 'Ajouter un événement',
            click : () => {
              this.$emit('toggle-add-event-popup')
            }
          }
        },
        headerToolbar: this.dynamicHeaderToolbar,
        buttonText: {
          today: 'Aujourd\'hui',
          month: 'Mois',
          week: 'Semaine',
          next: '>',
          prev: '<'
        },
        slotMinTime: '08:00:00',
        slotMaxTime: '22:00:00',
        slotDuration: '0:30:00',
        selectable: true,
      },
    }
  },
  methods: {
    // Your methods here
  }
}
</script>

<style scoped>
/* Styles for the calendar component */
.calendar {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  margin: 20px;
  border: 1px solid #ccc;
  border-radius: 8px;
  background-color: white;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.419);
}
</style>
