<template>
  <div class="blur-overlay">
    <main class="popup">
      <div class="event-form">
        <div class="close-popup" @click="$emit('toggle-delete-event-popup')">
          <font-awesome-icon :icon="['fas', 'times']" size="xl" />
        </div>
        <h2 class="form-title">Voulez vous supprimer l'événement suivant ?</h2>
        <div class="card">
          <div class="card-header">
            <p> {{ this.selectedEvent.title }}</p>
          </div>
          <div class="card-content">
            <p> {{ handleLocation(this.selectedEvent.extendedProps.location) }}</p>
            <p> {{ handleDate(this.selectedEvent.start, this.selectedEvent.end) }}</p>
          </div>
        </div>
        <h4 v-if="this.selectedEvent.extendedProps.eventIsRepeatedWeekly"> Cet événement est répété chaque semaine, toutes ses répétitions seront supprimées.</h4>
        <form @submit.prevent="handleDeleteEvent(this.selectedEvent.id)" class="flex-form">
          <div class="button-container">
            <button type="submit">Supprimer</button>
            <button @click="$emit('toggle-delete-event-popup')">Annuler</button>
          </div>
        </form>
      </div>
    </main>
  </div>
</template>

<script>
import { mapActions,mapState } from 'vuex';
export default {
  data() {
    return {
     
    };
  },
  computed: {
    ...mapState(['selectedEvent']),
  },
  methods: {
    ...mapActions(['createEvent', 'fetchEvents','deleteEvent']),
    async handleCreateEvent (){
      try{
        await this.createEvent(this.eventData);
        await this.fetchEvents();
        this.resetForm();
        this.$emit('toggle-delete-event-popup');
      }catch(error){
        console.error(error);
      }
    },
    handleLocation(location) {
     switch(location){
      case "cosec_favier":
        return "Cosec Favier";
      case "dojo_montagnat":
        return "Dojo de Montagnat";
      case "ceyzeriat_petanque":
        return "Terrain de pétanque Ceyzériat"; 
      case "adapei":
        return "ADAPEI";
     }
    },
    handleDate(dateStart, dateEnd) {
      const convertedStartDate = new Date(dateStart);
      const convertedEndDate = new Date(dateEnd);

      const weekdays = [
        "Dimanche",
        "Lundi",
        "Mardi",
        "Mercredi",
        "Jeudi",
        "Vendredi",
        "Samedi",
      ];

      const months = [
        "janvier",
        "février",
        "mars",
        "avril",
        "mai",
        "juin",
        "juillet",
        "août",
        "septembre",
        "octobre",
        "novembre",
        "décembre",
      ];

      const startDay = weekdays[convertedStartDate.getDay()];
      const startDayNumber = convertedStartDate.getDate();
      const startMonth = months[convertedStartDate.getMonth()];
      const startTime = convertedStartDate.toLocaleTimeString("fr-FR", {
        hour: "2-digit",
        minute: "2-digit",
      });

      const endDay = weekdays[convertedEndDate.getDay()];
      const endDayNumber = convertedEndDate.getDate();
      const endMonth = months[convertedEndDate.getMonth()];
      const endTime = convertedEndDate.toLocaleTimeString("fr-FR", {
        hour: "2-digit",
        minute: "2-digit",
      });

      if (startDay === endDay && startDayNumber === endDayNumber && startMonth === endMonth) {
        // If the end date is the same day as the start date
        return `${startDay} ${startDayNumber} ${startMonth} à ${startTime}h jusqu'à ${endTime}h`;
      } else {
        // If the end date is a different day
        return `${startDay} ${startDayNumber} ${startMonth} à ${startTime}h jusqu'au ${endDay} ${endDayNumber} ${endMonth}${endTime}h`;
      }
    },
    async handleDeleteEvent(id){
        try {
          await this.deleteEvent(id)
          this.$emit('toggle-delete-event-popup');
          await this.fetchEvents();
        }catch(error){
          console.error(error);
          throw new error;
        }
    }
    
  },
}
</script>

<style scoped>
    .card {
      background-color: rgb(95, 197, 95);
      border-radius: 10prgb(70, 70, 228);
      padding: 5px;
      margin-bottom: 20px;
      color : white;
      border-radius: 8px;
      box-shadow: 0 0 5px #ccc;
    }

    .card .card-header {
      font-weight: bold;
    }
    
    .blur-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0);
        backdrop-filter: blur(5px);
        z-index: 999;
    }
    .event-form div {
        margin-top: 10px;
    }
    
    .popup {
        display: flex;
        justify-content: space-around;
        background-color: white;
        padding: 20px;
        width : 30%;
        min-width: 490px;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.419);
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1000;
    }
    
    /* Adjust the input label width */

    .form-title {
        font-size: 40px;
        border-bottom: 6px solid #4caf50;
        margin-bottom: 20px; /* Adjust this margin as needed */
        padding-bottom: 10px; /* Adjust this padding as needed */
    }

    .button-container {
      display : flex;
      flex-direction: row;
      justify-content: space-around;
    }

    
    .button-container button {
    width: 40%;
    padding: 10px;
    border: 1px solid #4caf50; 
    border-radius: 5px;
    font-size: 16px;
    background-color: #4caf50; /* Set a background color for the button */
    color: white; /* Text color for the button */
    cursor: pointer; /* Add a pointer cursor on hover */
    transition: background-color 0.3s, border-color 0.3s, box-shadow 0.3s, color 0.3s;
    }

    /* Style for button on hover */
    .button-container button:hover {
    background-color: white;
    color: #4caf50;
    border-color: #4caf50;
    }

    /* Style for button when focused */
    .button-container button:focus {
    outline: none;
    box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
    }

    .close-popup {
        cursor: pointer;
        position: fixed;
        padding: 1em;
        top: 0;
        right: 0;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .close-popup:hover {
        transform: scale(1.1);
        box-shadow: 0 2px 8px rgba (0, 0, 0, 0.3);
    }

  

  

</style>