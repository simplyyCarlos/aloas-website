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
import { mapState, mapActions } from 'vuex';

export default {
  computed: {
    ...mapState(["user", "events"]),

    dynamicHeaderToolbar() {
      if (this.user.is_admin && this.showDeletionDialog) {
        return {
          left: 'prev,next today addEventButton deleteEventButton',
          center: 'title',
          right: 'timeGridWeek,dayGridMonth'
        };
      }else if(this.user.is_admin){
        return {
          left: 'prev,next today addEventButton',
          center: 'title',
          right: 'timeGridWeek,dayGridMonth'
        };
      }
      else {
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
          allDay: event.eventIsAllDay,
          extendedProps: {
            location: event.eventLocation,
            description: event.eventDescription,
            eventIsRepeatedWeekly: event.eventIsRepeatedWeekly,
          },
        };
        mappedEvents.push(baseEvent);

        if (event.eventIsRepeatedWeekly) {
          const startDate = new Date(event.eventStartDate);
          const endDate = new Date(event.eventEndDate);
          const oneWeek = 7 * 24 * 60 * 60 * 1000; // One week in milliseconds

          for (let i = 1; i <= 52; i++) { // Repeat for one year (52 weeks)
            const newStart = new Date(startDate.getTime() + i * oneWeek);
            const newEnd = new Date(endDate.getTime() + i * oneWeek);

            const recurrEvent = {
              id: `${event.id}-repeated-${i}`,
              title: event.eventName,
              start: newStart.toISOString(),
              end: newEnd.toISOString(),
              allDay: event.eventIsAllDay,
              extendedProps: {
                location: event.eventLocation,
                description: event.eventDescription,
                eventIsRepeatedWeekly: true,
              },
            };
            mappedEvents.push(recurrEvent);
          }
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
      showDeletionDialog : false,
      calendarOptions: {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        initialView: 'timeGridWeek',
        contentHeight: 'auto',
        locale: frLocale,
        allDaySlot: false,
        // handle day click 
        eventClick: this.handleEventClick,
        customButtons: {
          addEventButton: {
            text: 'Ajouter un événement',
            click: () => {
              this.$emit('toggle-add-event-popup')
            }
          },
          deleteEventButton: {
            text: 'Supprimer un événement',
            click: () => {
              this.$emit('toggle-delete-event-popup')
            }
          }
        },
        events: this.calendarEvents,
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
    ...mapActions(['fetchEvents', 'deleteEvent','setSelectedEvent','createEvent']),
    ...mapState(['user']),
    async fetchEventsFromApi() {
      try {
        await this.fetchEvents();

      } catch (error) {
        console.error(error);
      }
    },
    async HandleOutdatedEvents() {
      for (const event of this.events) {
        const endDate = new Date(event.eventEndDate);
        const today = new Date();
        if(event.eventIsRepeatedWeekly && endDate < today){
          const newStart = new Date (event.eventStartDate);
          const newEnd = new Date (event.eventEndDate);
          newStart.setDate(newStart.getDate() + 7);
          newEnd.setDate(newEnd.getDate() + 7);
          await this.deleteEvent(event.id);
          await this.createEvent(event.eventName, newStart, newEnd, event.eventIsAllDay, event.eventIsRepeatedWeekly, event.eventLocation, event.eventDescription);
          await this.fetchEvents();
        }
        if (endDate < today) {
          try {
            await this.deleteEvent(event.id);
            await this.fetchEvents();
          } catch (error) {
            console.error(error);
          }
        }
      }
    },
    handleEventClick(event){
      if(!this.user.is_admin){
        return;
      }
        this.showDeletionDialog = !this.showDeletionDialog;
        this.setSelectedEvent(event.event);
    }
  },
  mounted() {
    this.fetchEventsFromApi();
    this.HandleOutdatedEvents();
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
