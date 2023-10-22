import { createStore } from 'vuex';
import { loginUser, addEvent,getEvents } from './api'; 

export default createStore({
  state: {
    isAuthenticated: false,
    user: {},
    events:[],
  },
  mutations: {
    loginUser(state, user) {
      state.isAuthenticated = true;
      state.user = user;
    },
    logoutUser(state) {
      state.isAuthenticated = false;
      state.user = {};
    },
    setEvents(state, events) {
      state.events = events;
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

    async login({ commit }, { email, password }) {
      try {
        
        const userData = await loginUser(email, password);
        commit('loginUser', userData);
      } catch (error) {
        console.error(error);
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
  },
});
