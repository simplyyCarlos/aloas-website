import { createStore } from 'vuex';
import axios from 'axios';
import { showSucess, showError } from './toastService';
import { loginUser, addEvent,getEvents,deleteEvent } from './api'; 

export default createStore({
  state: {
    isAuthenticated: false,
    user: {},
    events:[],
    showCreateAccountPopUp: false,
  },
  mutations: {
    loginUser(state, user) {
      state.isAuthenticated = true;
      state.user = user;
    },
    logoutUser(state) {
      state.isAuthenticated = false;
      showSucess('Vous êtes déconnecté');
      state.user = {};
    },
    setEvents(state, events) {
      state.events = events;
    },
    mutationToggleCreateAccountPopUp(state) {
      state.showCreateAccountPopUp = !state.showCreateAccountPopUp;
      console.log(state.showCreateAccountPopUp);
    },
  },
  actions: {
    async fetchEvents({ commit }) {
      try {
        const events = await getEvents(); // Call the getEvents function from 'api.js'
        commit('setEvents', events); // Update the state with the retrieved events
      } catch (error) {
        console.error(error);
        throw error;
      }
    },
    async deleteEvent({ commit }, eventId) {
      try{
        await deleteEvent(eventId);
      }catch(error){
        console.error(error);
        throw error;
      }
    },
    async login({ commit }, { email, password }) {
      try {
        const userData = await loginUser(email, password);
        commit('loginUser', userData);
        showSucess(`Bienvenue ${userData.prenom} ${userData.nom} !`);
      } catch (error) {
        console.error(error);
        showError('Email ou mot de passe incorrect');
        throw error; 
      }
    },
    async createEvent({ commit }, eventData) {
      try {
        const response = await addEvent(
          eventData.eventName,
          eventData.eventStartDate,
          eventData.eventEndDate,
          eventData.eventIsAllDay,
          eventData.eventIsRepeatedWeekly,
          eventData.eventLocation,
          eventData.eventDescription
        );
        return response;
        } catch (error) {
        console.error(error);
        throw error; 
      }
    }, 
    logout({ commit }) {
      commit('logoutUser');
    },
    actionToggleCreateAccountPopUp({ commit }) {
      commit('mutationToggleCreateAccountPopUp');
    },
  },
});
