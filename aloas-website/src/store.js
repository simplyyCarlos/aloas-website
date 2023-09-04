import { createStore } from 'vuex';
import axios from 'axios';

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
        const response = await axios.get('http://localhost:8080/src/api/userApi.php', {
          params: {
            email,
            password,
          },
        });

        if (response.status === 200) {
          const userData = response.data;
          commit('loginUser', userData);
        } else if (response.status === 201) {
          throw new Error('Email ou mot de passe incorrect');
        } else {
          throw new Error('Une erreur est survenue');
        }
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