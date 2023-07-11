<template>
    <NavBar />
    <div class="sport-activities">
      <h1>Liste des activités sportives</h1>
      <ul>
        <li v-for="activity in activities" :key="activity.id">
          <h2>{{ activity.title }}</h2>
          <p>{{ activity.description }}</p>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import NavBar from "../components/NavBar.vue";
  export default {
    data() {
      return {
        activities: [
          {
            id: 1,
            title: "Football",
            description: "Le football est un sport collectif qui se joue avec un ballon sphérique..."
          },
          {
            id: 2,
            title: "Basketball",
            description: "Le basketball est un sport d'équipe qui se joue avec un ballon et deux paniers..."
          },
          {
            id: 3,
            title: "Natation",
            description: "La natation est une activité sportive qui consiste à se déplacer dans l'eau en utilisant..."
          },
          // Ajoutez d'autres activités sportives ici
        ]
      };
    },
    components: {
      NavBar
    }
  };
  </script>
  
  <style scoped>
  .sport-activities {
    margin: 20px;
  }
  
  h1 {
    font-size: 24px;
    margin-bottom: 10px;
  }
  
  ul {
    list-style: none;
    padding: 0;
  }
  
  li {
    margin-bottom: 20px;
  }
  
  h2 {
    font-size: 18px;
    margin-bottom: 5px;
  }
  
  p {
    font-size: 14px;
    margin-bottom: 0;
  }
  </style>
  