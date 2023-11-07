<script >
import CalendarComponent from '../components/CalendarComponent.vue';
import NavBar from '../components/NavBar.vue';
import { mapState } from 'vuex';
import AddEventPopup from '../components/AddEventPopup.vue';
import DeleteEventPopup from '../components/DeleteEventPopup.vue';

export default {
    computed : {
      ...mapState(["isAuthenticated","user"]),
    },
    components: {
    CalendarComponent,
    NavBar,
    AddEventPopup,
    DeleteEventPopup
},
    methods :{
      toggleDeleteEventPopup(){
        this.showDeleteEventPopup = !this.showDeleteEventPopup;
      },
      toggleAddEventPopup(){
        this.showAddEventPopup = !this.showAddEventPopup;
      }
    },
    data(){
      return {
        showAddEventPopup : false,
        showDeleteEventPopup : false,
      }
    }
};
</script>

<template>
    <div class="calendar">
      <NavBar />
      <AddEventPopup @toggle-add-event-popup="toggleAddEventPopup" v-if="showAddEventPopup"/>
      <DeleteEventPopup @toggle-delete-event-popup="toggleDeleteEventPopup" v-if="showDeleteEventPopup"/>
      <CalendarComponent @toggle-delete-event-popup="toggleDeleteEventPopup" @toggle-add-event-popup="toggleAddEventPopup"></CalendarComponent>
      
    </div>
  </template>
  
<style scoped>
  /* Add styles for the event form */
  .calendar {
    display: flex;
    flex-direction: column;
    
  }
  
  
</style>
  

  
  