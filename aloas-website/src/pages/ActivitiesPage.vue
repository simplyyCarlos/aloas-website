<template>
  <NavBar />
  <main class="activities-container">
    <div class="activity-card">
      <div class="card-img">
        <img src="src/assets/img/activities/judo.jpeg" alt="Judo" class="activity-image">
      </div>
      <div class="activity-details">
        <div class="main-infos">
          <h3>Judo</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, veniam repudiandae alias nemo similique voluptatibus culpa modi blanditiis. Voluptates aut veniam pariatur inventore maxime nam consectetur odio culpa exercitationem aliquam.</p>
        </div>
        <div class="sub-infos">
          <p><strong>Horaires:</strong> Samedi et Dimanche de 14h à 16h</p>
          <p><strong>Location:</strong> Terrain de pétanque XYZ</p>
        </div>
      </div>
    </div>
    <div class="activity-card">
      <div class="card-img">
        <img src="src/assets/img/activities/photographie.jpg" alt="Photographie" class="activity-image">
      </div>
      <div class="activity-details">
        <div class="main-infos">
          <h3>Photographie</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, veniam repudiandae alias nemo similique voluptatibus culpa modi blanditiis. Voluptates aut veniam pariatur inventore maxime nam consectetur odio culpa exercitationem aliquam.</p>
        </div>
        <div class="sub-infos">
          <p><strong>Horaires:</strong> Samedi et Dimanche de 14h à 16h</p>
          <p><strong>Location:</strong> Terrain de pétanque XYZ</p>
        </div>
      </div>
    </div>
    <div class="activity-card">
      <div class="card-img">
        <img src="src/assets/img/activities/multisport.jpeg" alt="Multisport" class="activity-image">
      </div>
      <div class="activity-details">
        <div class="main-infos">
          <h3>Multisport</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, veniam repudiandae alias nemo similique voluptatibus culpa modi blanditiis. Voluptates aut veniam pariatur inventore maxime nam consectetur odio culpa exercitationem aliquam.</p>
        </div>
        <div class="sub-infos">
          <p><strong>Horaires:</strong> Samedi et Dimanche de 14h à 16h</p>
          <p><strong>Location:</strong> Terrain de pétanque XYZ</p>
        </div>
      </div>
    </div>
    <div class="activity-card">
      <div class="card-img">
        <img src="src/assets/img/activities/petanque.jpeg" alt="Pétanque" class="activity-image">
      </div>
      <div class="activity-details">
        <div class="main-infos">
          <h3>Pétanque</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, veniam repudiandae alias nemo similique voluptatibus culpa modi blanditiis. Voluptates aut veniam pariatur inventore maxime nam consectetur odio culpa exercitationem aliquam.</p>
        </div>
        <div class="sub-infos">
          <p><strong>Horaires:</strong> Samedi et Dimanche de 14h à 16h</p>
          <p><strong>Location:</strong> Terrain de pétanque XYZ</p>
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
import { ref, onMounted } from "vue";
import NavBar from "../components/NavBar.vue";
</script>

<style scoped>

.activities-container {
  margin-top: 30px;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-content: flex-start;
  min-height: 80vh;
}

.activity-card {
  width: calc(25% - 20px);
  height: 600px;
  border: 1px solid black;
  margin: 10px;
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  color : white;
  background-color: #4caf50;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
  overflow: hidden;
}

.activity-details {
  height: 100%;
  padding: 20px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;

}

.activity-image {
  width: 100%;
  max-height: 200px;
  object-fit: cover;
}

@media (max-width: 768px) {
  .activity-card {
    width: calc(50% - 20px);
  }
}

@media (max-width: 480px) {
  .activity-card {
    width: calc(100% - 20px);
  }
}
</style>
