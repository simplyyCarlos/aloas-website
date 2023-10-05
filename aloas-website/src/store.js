import { createStore } from 'vuex';
import { loginUser } from './api'; // Import the API function

export default createStore({
  state: {
    isAuthenticated: false,
    user: {},
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
  },
  actions: {
    async login({ commit }, { email, password }) {
      try {
        // Call the API function for login
        const userData = await loginUser(email, password);
        commit('loginUser', userData);
      } catch (error) {
        console.error(error);
        throw error; // Rethrow the error to be caught by the component
      }
    },
    logout({ commit }) {
      commit('logoutUser');
    },
  },
});
