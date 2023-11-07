<script>
import {mapState, mapActions} from 'vuex';
import LoginPopup from "./LoginPopup.vue";
export default {
  computed:{
    ...mapState(["isAuthenticated","user"]),
  },
  methods: {
    ...mapActions(["logout"]),
    toggleNav(){
      this.isNavOpen = !this.isNavOpen;
    },
    toggleLoginPopup() {
      this.showLoginPopup = !this.showLoginPopup;
    },
  },
  components : {
    LoginPopup,
  },
  data(){
    return {
      showLoginPopup: false,
      isNavOpen: false,
    };
  },
};
</script>

<template>
  <nav class="navbar">
    <div class="logo">
      <router-link to="/" class="router-link">
        <img src="../assets/img/logo/logo.png" alt="Logo" />
      </router-link>
    </div>
    <div class="nav-toggle" @click="toggleNav">
      <i class="fa fa-bars"></i>
    </div>
    <ul :class="{ 'nav-open': isNavOpen }">
      <li class="nav-item"><router-link to="/" class="router-link">Accueil</router-link></li>
      <li class="nav-item"><router-link to="/articles" class="router-link">Actualités</router-link></li>
      <li class="nav-item"><router-link to="/activities" class="router-link">Activités</router-link></li>
      <li class="nav-item"><router-link to="/planning" class="router-link">Planning</router-link></li>
      <li class="nav-item"><router-link to="/about" class="router-link">À propos</router-link></li>
      <li class="nav-item"><router-link to="/contact" class="router-link">Nous Contacter</router-link></li>
    </ul>
    <div class="sign-in">
      <template v-if="isAuthenticated">
        <span class="username">{{ user.nom }} {{ user.prenom }}</span>
        <i class="fa fa-sign-out" @click="logout()"></i>
      </template>
      <template v-else>
        <i class="fa fa-sign-in" @click="toggleLoginPopup"></i>
      </template>
    </div>
  </nav>
  <LoginPopup  @toggle-login-popup="toggleLoginPopup"  v-if="showLoginPopup"/>
</template>



<style scoped>
.navbar {
  background-color: rgb(95, 197, 95);
  height: 100px;
  width: 100%;
  border-bottom: 1px solid black;
  display: flex;
  align-items: center;
  padding: 0 20px;
}

.logo img {
  height: 70px;
  /* Adjust the height as needed */
  width: 170px;
  margin-right: 10px;
}

.nav-toggle {
  display: none;
  /* Hide the nav toggle by default */
  cursor: pointer;
}

.nav-toggle i {
  color: white;
  font-size: 1.5rem;
}

.navbar ul {
  display: flex;
  justify-content: space-around;
  align-items: center;
  list-style: none;
  padding: 10;
  margin: 0;
}

.navbar .nav-item {
  color: white;
  font-weight: bold;
  cursor: pointer;
  margin-right: 50px;
  font-size: 1.5rem;
  transition: 0.3s;
  /* Add transition property */
  position: relative;
  /* Add position relative to create space for the line */
}

.navbar .nav-item::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: -3px;
  width: 100%;
  height: 2px;
  background-color: white;
  transform: scaleX(0);
  transition: transform 0.3s;
  /* Add transition property for the line */
}

.navbar .nav-item:hover::after {
  transform: scaleX(1);
  /* Expand the line on hover */
}

.sign-in {
  display: flex;
  flex-direction: row;
  align-items: center;
  margin-left: auto;
}

.sign-in i {
  color: white;
  font-size: 1.75rem;
  cursor: pointer;
}
.sign-in .username {
  font-size: 1.75rem;
}

.router-link {
  color: white;
  text-decoration: none;
}

span {
  color: white;
  font-weight: bold;
  cursor: pointer;
  margin-right: 50px;
  font-size: 1.5rem;
  transition: 0.3s;
  /* Add transition property */
  position: relative;
  /* Add position relative to create space for the line */
}

@media (max-width: 1205px) {
  .navbar .nav-item[data-v-c3ceb15a] {
    font-size: 1.15rem;
  }

  
}

@media (max-width: 1064px) {
  .navbar .nav-item[data-v-c3ceb15a] {
    font-size: 1rem;
  }

  
}

@media (max-width: 999px) {
  .navbar .nav-item[data-v-c3ceb15a] {
    font-size: 0.7rem;
  }

  .sign-in .username {
    font-size: 1rem;
  }
}

@media (max-width: 768px) {

  /* Styles for screens smaller than 768px */
  .navbar {
    flex-direction: column;
    padding: 10px;
  }


  .logo img {
    height: 70px;
    width: 200px;
  }

  .nav-toggle {
    position: fixed;
    display: flex;
    margin-right: auto;
    left: 0;
    top: 20px;
    padding: 20px;
  }

  .navbar ul {
    display: none;
    width: 106%;
    background-color: rgb(36, 163, 36);
    padding: 10px;
    margin-top: 10px;
  }

  .navbar ul.nav-open {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .nav-open {
    display: flex;
    flex-direction: column;
    align-items: center;
    z-index: 100;
  }

  .navbar .nav-item {
    margin: 10px 0;
    text-align: center;
  }

  .sign-in {
    position: fixed;
    right: 0;
    top: 50px;
    transform: translateY(-50%);
    padding: 20px;
  }

  .sign-in .username {
    display : none;
  }
}
</style>
