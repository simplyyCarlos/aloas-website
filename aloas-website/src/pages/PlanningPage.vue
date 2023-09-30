<script >
import CalendarComponent from '../components/CalendarComponent.vue';
import NavBar from '../components/NavBar.vue';
import { mapState } from 'vuex';

export default {
    computed:{
        ...mapState(["user"]),
    },
    components: {
        CalendarComponent,
        NavBar
    }
};
</script>

<template>
    <NavBar/>
    <main class="calendar">
        <div class="admin-panel" v-if="user.is_admin">
                <div class="event-form">
                <h2>Ajouter un événement au calendrier : </h2>
                <form @submit.prevent="createEvent" class="flex-form">
                    <div class="form-group">
                        <label for="eventName" class="input-label">Nom de l'événement:</label>
                        <input type="text" id="eventName" v-model="eventName" required class="input-field" />
                    </div>
                    <div class="form-group">
                        <label for="eventStartDate" class="input-label">Date de l'événement:</label>
                        <input type="datetime-local" id="eventStartDate" v-model="eventStartDate" required class="input-field" />
                    </div>
                    <div class="form-group">
                        <label for="eventEndDate" class="input-label">Date de fin de l'événement:</label>
                        <input type="datetime-local" id="eventEndDate" v-model="eventEndDate" required class="input-field" />
                    </div>
                    <div class="form-group">
                        <label for="isAllDay" class="checkbox-label">Toute la journée:</label>
                        <input type="checkbox" id="isAllDay" v-model="isAllDay" class="checkbox-field" />
                    </div>
                    <div class="form-group">
                        <label for="isRepeatedWeekly" class="checkbox-label">Répété chaque semaine:</label>
                        <input type="checkbox" id="isRepeatedWeekly" v-model="isRepeatedWeekly" class="checkbox-field" />
                    </div>
                    <div class="form-group">
                        <label for="eventStartTime" class="input-label">Heure de début:</label>
                        <input type="time" id="eventStartTime" v-model="eventStartTime" class="input-field" />
                    </div>
                    <div class="form-group">
                        <label for="eventStopTime" class="input-label">Heure de fin:</label>
                        <input type="time" id="eventStopTime" v-model="eventStopTime" class="input-field" />
                    </div>
                    <div class="form-group">
                        <label for="eventDescription" class="input-label">Description de l'événement:</label>
                        <textarea id="eventDescription" v-model="eventDescription" class="textarea-field"></textarea>
                    </div>
                </form>
                <div class="button-container">
                    <button type="submit">Ajouter</button>
                </div>
            </div>
            <div class="event-list">
                <h2>Gérez les événements : </h2>
            </div>
        </div>
        
        <CalendarComponent></CalendarComponent>
    </main>
</template>

<style scoped>
/* Add styles for the event form */
.calendar .admin-panel{
    display : flex;
}


.calendar .event-form, .event-list {
    background-color: #f0f0f0;
    padding: 20px;
    width: 50%;
    min-width: 500px;
    border: 1px solid #ccc;
    border-radius: 8px;
    margin: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.419);
}

.event-form h2 {
    margin-bottom: 10px;
}

.flex-form {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
}

.form-group {
    flex: 1;
    min-width: 200px;
    margin-right: 10px;
    margin-bottom: 15px;
}

.form-group textarea {
  
}

.input-label {
    font-weight: bold;
    
    margin-bottom: 5px;
    display: block;
}

.checkbox-label {
    
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
}

.input-field,
.checkbox-field {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.input-field:focus,
.checkbox-field:focus {
    outline: none;
    border-color: #4caf50; /* Highlight input when focused */
    box-shadow: 0 0 5px rgba(76, 175, 80, 0.5); /* Add a box shadow when focused */
}

.button-container {
    text-align: center;
    margin-top: 20px;
}
</style>
