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
    <ul :class="{'nav-open': isNavOpen}">
      <li class="nav-item"><router-link to="/" class="router-link">Accueil</router-link></li>
      <li class="nav-item"><router-link to="/articles" class="router-link">Articles</router-link></li>
      <li class="nav-item">Événements</li>
      <li class="nav-item">À propos</li>
      <li class="nav-item">Nous contacter</li>
    </ul>
    <div class="sign-in">
      <i :class="isLoggedIn ? 'fa fa-sign-in' : 'fa fa-sign-out'" @click="$emit('toggle-login-popup')"></i>
    </div>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      isNavOpen: false,
      isLoggedIn: false
    };
  },
  methods: {
    toggleNav() {
      this.isNavOpen = !this.isNavOpen;
    },
    toggleLogin() {
      this.isLoggedIn = !this.isLoggedIn;
     
    }
  }
};
</script>

<style scoped>
.navbar {
  background-color: rgb(95, 197, 95);
  height: 100px;
  display: flex;
  align-items: center;
  padding: 0 20px;
}

.logo img {
  height: 70px; /* Adjust the height as needed */
  width: 170px;
  margin-right: 10px;
}

.nav-toggle {
  display: none; /* Hide the nav toggle by default */
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
  transition: 0.3s; /* Add transition property */
  position: relative; /* Add position relative to create space for the line */
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
  transition: transform 0.3s; /* Add transition property for the line */
}

.navbar .nav-item:hover::after {
  transform: scaleX(1); /* Expand the line on hover */
}

.sign-in {
  position: fixed;
  right: 20px;
  top: 50px;
  transform: translateY(-50%);
  padding: 20px;
}

.sign-in i {
  color: white;
  font-size: 1.75rem;
  cursor: pointer;
}

.router-link {
  color: white;
  text-decoration: none;
}

@media (max-width: 1050px) {
    .navbar .nav-item[data-v-c3ceb15a] {
        font-size: 1rem;
    }
}

@media (max-width: 873px) {
    .navbar .nav-item[data-v-c3ceb15a] {
        font-size: 0.7rem;
    }
}

@media (max-width: 768px) {
  /* Styles for screens smaller than 768px */
  .navbar {
    flex-direction: column;
    padding: 10px;
  }


  .logo img{
    height: 70px ;
    width: 200px;
  }
  .nav-toggle {
    position: fixed;
    display: flex;
    margin-right: auto;
    left : 0;
    top  : 20px;
    padding: 20px;
  }

  .navbar ul {
    display: none;
    width: 100%;
    background-color: rgb(36, 163, 36);
    padding: 10px;
    margin-top: 10px;
  }

  .navbar ul.nav-open {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .nav-open{
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
}
</style>
