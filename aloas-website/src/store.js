import { createStore } from 'vuex';
import axios from 'axios';
import { showSucess, showError } from './toastService';

export default createStore({
  state: {
    isAuthenticated: false,
    user: {},
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
    mutationToggleCreateAccountPopUp(state) {
      state.showCreateAccountPopUp = !state.showCreateAccountPopUp;
      console.log(state.showCreateAccountPopUp);
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
          showSucess(`Bienvenue ${userData.prenom} ${userData.nom} !`);
          commit('loginUser', userData);
        } else if (response.status === 201) {
          showError('Email ou mot de passe incorrect');
          throw new Error('Email ou mot de passe incorrect');
        } else {
          showError('Une erreur est survenue');
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
    actionToggleCreateAccountPopUp({ commit }) {
      commit('mutationToggleCreateAccountPopUp');
    },
  },
});