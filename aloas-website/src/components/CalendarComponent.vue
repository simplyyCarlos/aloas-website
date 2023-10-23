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
import { mapState,mapActions } from 'vuex';

export default {
  computed: {
    ...mapState(["user","events"]),
    
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
          right: 'timeGridWeek,dayGridMonth'
        };
      }
    },
    calendarEvents() {
      
      const mappedEvents = [];
      this.events.forEach(event => {
        const baseEvent = {
          id: event.id, // Unique identifier for the event
          title: event.eventName,
          start: event.eventStartDate,
          end: event.eventEndDate,
          allDay: event.eventIsAllDay === 1,
          extendedProps: {
            location: event.eventLocation,
            description: event.eventDescription,
          },
        };

        if (event.eventIsRepeatedWeekly) {
          // Handle recurring events by adding multiple instances
          const startDate = new Date(event.eventStartDate);
          const endDate = new Date(event.eventEndDate);

          while (startDate <= endDate) {
            mappedEvents.push({
              ...baseEvent,
              start: new Date(startDate),
              end: new Date(startDate),
            });

            startDate.setDate(startDate.getDate() + 7); // Add 7 days for weekly recurrence
          }
        } else {
          // Non-recurring event
          mappedEvents.push(baseEvent);
        }
    });

    return mappedEvents;
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
    calendarEvents: {
      handler(newEvents) {
        this.$nextTick(() => {
          if (this.$refs.calendar) {
            this.calendarOptions.events = newEvents;
            const calendarApi = this.$refs.calendar.getApi();
            if (calendarApi) {
              calendarApi.setOption('events', newEvents);
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
        initialView: 'timeGridWeek',
        contentHeight: 'auto',
        locale: frLocale,
        allDaySlot: false,
        dateClick: this.handleDateClick,
        eventClick: this.handleEventClick,
        customButtons: {
          addEventButton: {
            text: 'Ajouter un événement',
            click : () => {
              this.$emit('toggle-add-event-popup')
            }
          }
        },
        events : this.calendarEvents,
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
  methods:{
    ...mapActions(['fetchEvents']),
    async fetchEventsFromApi(){
      try{
        await this.fetchEvents();
        
      }catch(error){
        console.error(error);
      }
      
     
    },
  },
  mounted() {
    this.fetchEventsFromApi();
  },
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
