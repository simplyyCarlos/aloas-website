<template>
  <NavBar />
  <div class="carousel">
    <div class="carousel-slides" :style="{ transform: `translateX(-${slideIndex * slideWidth}px)` }">
      <div class="carousel-slide" v-for="(slide, index) in slides" :key="index">
        <img :src="slide" alt="Carousel Slide" class="slide-image">
      </div>
    </div>
    <div class="carousel-controls">
      <div class="control-button left" @click="previousSlide">
        <i class="fa fa-arrow-left"></i>
      </div>
      <div class="control-button right" @click="nextSlide">
        <i class="fa fa-arrow-right"></i>
      </div>
    </div>
  </div>
  <div class="sport-activities">
    <h1>Liste des activités sportives</h1>
    <ul class="activity-list">
      <li v-for="sports in sports" :key="sports.id">
        <div class="activity-container">
          <div class="activity-image">
            <img src="src/assets/img/articles/articles.jpg" alt="Sport Image">
          </div>
          <div class="description">
            <h2>{{ sports.title }}</h2>
            <h3 class="activity-date">{{ sports.date }}</h3>
            <p class="activity-description">{{ sports.description }}</p>
          </div>
        </div>
      </li>
    </ul>
    <h1>Liste des activités culturelle</h1>
      <ul class="activity-list">
        <li v-for="activites in activites" :key="activites.id">
          <div class="activity-container">
            <div class="activity-image">
              <img src="src/assets/img/articles/articles.jpg" alt="Activitie Image">
            </div>
            <div class="description">
              <h2>{{ activites.title }}</h2>
              <h3 class="activity-date">{{ activites.date }}</h3>
              <p class="activity-description">{{ activites.description }}</p>
            </div>
          </div>
        </li>
      </ul>
  </div>
  <Footer></Footer>
</template>
  
<script setup>
import { ref, onMounted } from "vue";
import NavBar from "../components/NavBar.vue";
import Footer from "../components/Footer.vue";
const slides = [
  'src/assets/img/carousel/image1.png',
  'src/assets/img/carousel/image2.jpg',
  'src/assets/img/carousel/image3.jpg',
];

const slideIndex = ref(0);
const slideWidth = ref(0);
const autoScroll = true;
const intervalDuration = 5000;
let intervalId;

const nextSlide = () => {
  if (slideIndex.value < slides.length - 1) {
    slideIndex.value++;
  } else {
    slideIndex.value = 0;
  }
};

const previousSlide = () => {
  if (slideIndex.value > 0) {
    slideIndex.value--;
  } else {
    slideIndex.value = slides.length - 1;
  }
};

onMounted(() => {
  slideWidth.value = document.querySelector('.carousel-slide').clientWidth;
  startAutoScroll();
});

window.addEventListener('resize', () => {
  slideWidth.value = document.querySelector('.carousel-slide').clientWidth;
  resetAutoScroll();
});

const startAutoScroll = () => {
  if (autoScroll) {
    intervalId = setInterval(nextSlide, intervalDuration);
  }
};
const resetAutoScroll = () => {
  clearInterval(intervalId);
  startAutoScroll();
};
</script>
  
<script>
export default {
  data() {
    return {
      sports: [
        {
          id: 1,
          title: "Football",
          date: "Lundi et Vendredi",
          description: "cras tincidunt lobortis feugiat vivamus at augue eget arcu dictum varius duis at consectetur lorem donec massa sapien faucibus et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt ornare massa eget egestas purus viverra accumsan in nisl nisi scelerisque eu ultrices vitae auctor eu augue ut lectus arcu bibendum at varius vel pharetra vel turpis nunc eget lorem dolor sed viverra ipsum nunc aliquet bibendum enim facilisis gravida neque convallis a cras semper auctor neque vitae tempus quam pellentesque nec nam aliquam sem et tortor consequat id porta nibh venenatis cras sed felis eget velit"
        },
        {
          id: 2,
          title: "Basketball",
          date: "Lundi et Vendredi",
          description: "cras tincidunt lobortis feugiat vivamus at augue eget arcu dictum varius duis at consectetur lorem donec massa sapien faucibus et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt ornare massa eget egestas purus viverra accumsan in nisl nisi scelerisque eu ultrices vitae auctor eu augue ut lectus arcu bibendum at varius vel pharetra vel turpis nunc eget lorem dolor sed viverra ipsum nunc aliquet bibendum enim facilisis gravida neque convallis a cras semper auctor neque vitae tempus quam pellentesque nec nam aliquam sem et tortor consequat id porta nibh venenatis cras sed felis eget velit"
        },
        {
          id: 3,
          title: "Natation",
          date: "Lundi et Vendredi",
          description: "cras tincidunt lobortis feugiat vivamus at augue eget arcu dictum varius duis at consectetur lorem donec massa sapien faucibus et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt ornare massa eget egestas purus viverra accumsan in nisl nisi scelerisque eu ultrices vitae auctor eu augue ut lectus arcu bibendum at varius vel pharetra vel turpis nunc eget lorem dolor sed viverra ipsum nunc aliquet bibendum enim facilisis gravida neque convallis a cras semper auctor neque vitae tempus quam pellentesque nec nam aliquam sem et tortor consequat id porta nibh venenatis cras sed felis eget velit"
        },
        // Ajoutez d'autres activités sportives ici
      ],

      activites: [
        {
          id: 1,
          title: "Photo",
          date: "Lundi et Vendredi",
          description: "cras tincidunt lobortis feugiat vivamus at augue eget arcu dictum varius duis at consectetur lorem donec massa sapien faucibus et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt ornare massa eget egestas purus viverra accumsan in nisl nisi scelerisque eu ultrices vitae auctor eu augue ut lectus arcu bibendum at varius vel pharetra vel turpis nunc eget lorem dolor sed viverra ipsum nunc aliquet bibendum enim facilisis gravida neque convallis a cras semper auctor neque vitae tempus quam pellentesque nec nam aliquam sem et tortor consequat id porta nibh venenatis cras sed felis eget velit"
        },
        {
          id: 2,
          title: "Théâtre",
          date: "Lundi et Vendredi",
          description: "cras tincidunt lobortis feugiat vivamus at augue eget arcu dictum varius duis at consectetur lorem donec massa sapien faucibus et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt ornare massa eget egestas purus viverra accumsan in nisl nisi scelerisque eu ultrices vitae auctor eu augue ut lectus arcu bibendum at varius vel pharetra vel turpis nunc eget lorem dolor sed viverra ipsum nunc aliquet bibendum enim facilisis gravida neque convallis a cras semper auctor neque vitae tempus quam pellentesque nec nam aliquam sem et tortor consequat id porta nibh venenatis cras sed felis eget velit"
        },
        {
          id: 3,
          title: "Dessin",
          date: "Lundi et Vendredi",
          description: "cras tincidunt lobortis feugiat vivamus at augue eget arcu dictum varius duis at consectetur lorem donec massa sapien faucibus et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt ornare massa eget egestas purus viverra accumsan in nisl nisi scelerisque eu ultrices vitae auctor eu augue ut lectus arcu bibendum at varius vel pharetra vel turpis nunc eget lorem dolor sed viverra ipsum nunc aliquet bibendum enim facilisis gravida neque convallis a cras semper auctor neque vitae tempus quam pellentesque nec nam aliquam sem et tortor consequat id porta nibh venenatis cras sed felis eget velit"
        },
        // Ajoutez d'autres activités sportives ici
      ],

    };
  },
  components: {
    NavBar
  }
};
</script>

<style scoped>
.carousel {
  position: relative;
  overflow: hidden;
  height: 20rem;
}

.carousel-slides {
  display: flex;
  transition: transform 0.5s ease;
}

.carousel-slide {
  flex-shrink: 0;
  width: 100%;
}

.slide-image {
  width: 100%;
  height: auto;
}

.carousel-controls {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 100%;
}

.control-button {
  display: inline-block;
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  padding: 10px;
  background-color: rgba(0, 0, 0, 0.5);
  color: #fff;
  cursor: pointer;
  z-index: 2;
}

.left {
  left: 10px;
}

.right {
  right: 10px;
}

.control-button i {
  font-size: 24px;
}

.sport-activities {
  margin: 20px;
}

.activity-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.activity-container {
  display: grid;
  grid-template-columns: auto 1fr;
  /* Adjust the column width as needed */
  column-gap: 10px;
  /* Adjust the gap between columns as needed */
  align-items: center;
  /* Vertically center items */
  padding: 20px;
}

.activity-image img {
  max-width: 100%;
  height: auto;
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
  margin-top: 5px;
}

h3 {
  font-size: 16px;
  margin-bottom: 5px;
  font-weight: 200;
}

p {
  font-size: 16px;
  margin-bottom: 0;
  background-color: #f0f0f0;
  padding: 10px;
  border-radius: 10px;
  text-align: justify;
  max-height: 200px; /* Adjust this value to your desired maximum height */
  overflow-y: auto;
}

@media screen and (max-width: 768px) {
  .activity-container {
    grid-template-columns: 1fr;
  }
}
</style>
  