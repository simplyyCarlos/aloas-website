<template>
  <div class="blur-overlay">
    <main class="popup">
      <div class="event-form">
        <div class="close-popup" @click="$emit('toggle-add-event-popup')">
          <font-awesome-icon :icon="['fas', 'times']" size="xl" />
        </div>
        <h2 class="form-title">Ajouter un événement au calendrier</h2>
        <form @submit.prevent="handleCreateEvent()" class="flex-form">
          <div class="form-group">
            <label for="eventName" class="input-label">Nom de l'événement:</label>
            <input type="text" id="eventName" required class="input-field" v-model="eventData.eventName" />
          </div>
          <div class="date-time-group">
            <div class="form-group">
              <label for="eventStartDate" class="input-label">Date de l'événement:</label>
              <input type="datetime-local" id="eventStartDate" required class="input-field" v-model="eventData.eventStartDate" />
            </div>
            <div class="form-group">
              <label for="eventEndDate" class="input-label">Date de fin:</label>
              <input type="datetime-local" id="eventEndDate" required class="input-field" v-model="eventData.eventEndDate" />
            </div>
          </div>
          <div class="checkbox-group">
            <div class="form-group">
              <label for="isAllDay" class="checkbox-label">Toute la journée:</label>
              <input type="checkbox" id="isAllDay" class="checkbox-field" v-model="eventData.eventIsAllDay" />
            </div>
            <div class="form-group">
              <label for="isRepeatedWeekly" class="checkbox-label">Répété chaque semaine:</label>
              <input type="checkbox" id="isRepeatedWeekly" class="checkbox-field" v-model="eventData.eventIsRepeatedWeekly" />
            </div>
          </div>
          <div class="form-group">
            <label for="eventLocation" class="input-label">Lieu de l'événement:</label>
            <select id="eventLocation" class="input-field" v-model="eventData.eventLocation">
              <option value="cosec_favier">COSEC Favier</option>
              <option value="dojo_montagnat">Dojo Montagnat</option>
              <option value="ceyzeriat_petanque">Ceyzériat - Pétanque</option>
              <option value="adapei">ADAPEI</option>
            </select>
          </div>
          <div class="form-group">
            <label for="eventDescription" class="input-label">Description de l'événement:</label>
            <textarea id="eventDescription" class="textarea-field" v-model="eventData.eventDescription"></textarea>
          </div>
          <div class="button-container">
            <button type="submit">Ajouter</button>
          </div>
        </form>
      </div>
    </main>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
export default {
  data() {
    return {
      eventData: {
        eventName: '',
        eventStartDate: '',
        eventEndDate: '',
        eventIsAllDay: false,
        eventIsRepeatedWeekly: false,
        eventLocation: 'location1',
        eventDescription: '',
      },
    };
  },
  methods: {
    ...mapActions(['createEvent', 'fetchEvents']),
    async handleCreateEvent (){
      try{
        await this.createEvent(this.eventData);
        await this.fetchEvents();
        this.resetForm();
        this.$emit('toggle-add-event-popup');
      }catch(error){
        console.error(error);
      }
    },
    resetForm(){
        this.eventData.eventName= '';
        this.eventData.eventStartDate= '';
        this.eventData.eventEndDate= '';
        this.eventData.eventIsAllDay= false;
        this.eventData.eventIsRepeatedWeekly= false;
        this.eventData.eventLocation= 'location1';
        this.eventData.eventDescription= '';
    },
  },
}
</script>

<style scoped>
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
        border: 1px solid #ccc;
        border-radius: 8px;
        min-width: fit-content;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.419);
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1000;
    }
    
    /* Adjust the input label width */
    .input-label {
        font-weight: bold;
        width: 180px; /* Set a minimum width for the input labels */
        display: inline-block; /* Keep them on the same line as the input */
        margin-bottom: 5px;
        vertical-align: top;
    }
    
    .date-time-group {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin-bottom: 15px;
        justify-content: center;
    }
    
    .form-title {
        font-size: 40px;
        border-bottom: 6px solid #4caf50;
        margin-bottom: 20px; /* Adjust this margin as needed */
        padding-bottom: 10px; /* Adjust this padding as needed */
    }
    
    .date-time-group .form-group:first-child {
        margin-right: 10px;
        
    }

    .date-time-group .form-group{
        align-items: center;
    }
    
    .checkbox-group {
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;
        align-items: center; /* Align checkboxes and labels vertically */
        margin-bottom: 15px;
    }
    
    .checkbox-label {
        font-weight: bold;
        margin-right: 10px;
        padding: 5px;
        border-radius: 5px;
        border: 0.5px solid #4caf50;
    }
    
    .checkbox-field {
        margin-right: 10px;
        padding: 5px;
    }
    

    .input-field,
    .textarea-field {
        width: 100%;
        padding: 10px;
        border: 1px solid #4caf50; /* Use the main color for borders */
        border-radius: 5px;
        font-size: 16px;
        transition: border-color 0.3s, box-shadow 0.3s;
        resize: none;
    }
    
    .input-field:focus,
    .textarea-field:focus {
        outline: none;
        border-color: #4caf50;
        box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
    }
    
    
    .button-container button {
    width: 100%;
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


    .form-group {
        align-self: stretch;
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

    select.input-field {
    padding: 10px;
    border: 1px solid #4caf50;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s, box-shadow 0.3s;
    width: 100%;
  }

  select.input-field:focus {
    outline: none;
    border-color: #4caf50;
    box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
  }

</style>