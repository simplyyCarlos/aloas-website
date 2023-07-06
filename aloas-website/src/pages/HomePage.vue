<script setup>
import { ref, onMounted } from 'vue';
import Footer from '../components/Footer.vue';
import NavBar from '../components/NavBar.vue';

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
  <main class="container">
    <div class="recent-articles">
      <h2 class="section-title">Articles récents</h2>
      <div class="article-list">
        <div v-for="article in articles" :key="article.id" class="article-item">
          <img :src="article.image" alt="Article Image" class="article-image">
          <div class="article-content">
            <h3 class="article-title"><a :href="article.link">{{ article.title }}</a></h3>
          </div>
        </div>
      </div>
    </div>
    <aside class="recent-events">
      <h2 class="section-title">Événements récents</h2>
      <ul class="event-list">
        <li v-for="event in events" :key="event.id" class="event-item">
          {{ event.title }}
        </li>
      </ul>
    </aside>
  </main>
  <Footer />
</template>

<script>
  export default {
    data() {
      return {
        articles: [
          {
            id: 1,
            title: "Titre de l'article 1",
            image: "chemin/vers/image1.jpg",
            link: "/articles/1"
          },
          {
            id: 2,
            title: "Titre de l'article 2",
            image: "chemin/vers/image2.jpg",
            link: "/articles/2"
          },
          {
            id: 3,
            title: "Titre de l'article 3",
            image: "chemin/vers/image3.jpg",
            link: "/articles/3"
          },
          {
            id: 4,
            title: "Titre de l'article 4",
            image: "chemin/vers/image4.jpg",
            link: "/articles/4"
          },
          {
            id: 5,
            title: "Titre de l'article 5",
            image: "chemin/vers/image5.jpg",
            link: "/articles/5"
          },
          {
            id: 6,
            title: "Titre de l'article 6",
            image: "chemin/vers/image6.jpg",
            link: "/articles/6"
          }
        ],
        events: [
          {
            id: 1,
            title: "Événement 1"
          },
          {
            id: 2,
            title: "Événement 2"
          },
          {
            id: 3,
            title: "Événement 3"
          }
        ]
      };
    }
  };
</script>

<style scoped>
.carousel {
  position: relative;
  overflow: hidden;
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

.container {
  display: grid;
  grid-template-columns: 2fr 1fr;
  grid-gap: 50px;
  padding: 10px;
}

.recent-articles {
  margin-bottom: 20px;
  margin-left: 25%;
  background-color: #a7a7a7;
  border-radius: 5%;
  box-shadow: 5px 5px 5px 5px rgb(211, 211, 211);
}

.section-title {
  font-size: 24px;
  margin-bottom: 10px;
  padding: 20px;
}

.article-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  grid-gap: 20px;
  padding: 20px;
}

.article-item {
  background-color: #f0f0f0;
  padding: 10px;
  border-radius: 2%;
}

.article-image {
  width: 100%;
  height: auto;
}

.article-content {
  padding: 10px;
}

.article-title {
  margin: 0;
}

.article-title a {
  color: #000;
  text-decoration: none;
}

.recent-events {
  background-color: #f0f0f0;
  padding: 10px;
  width: 50%;
  border-radius: 5%;
  box-shadow: 5px 5px 5px 5px rgb(211, 211, 211);
}

.event-list {
  padding: 0;
  margin: 0;
  list-style: none;
}

.event-item {
  margin-bottom: 10px;
}

@media (max-width: 768px) {
  .container {
    grid-template-columns: repeat(2, minmax(0, 1fr));
    justify-items: center;
    align-items: center;
    display: flex;
    flex-direction: column;
    row-gap: 10px;
  }

  .recent-articles {
    margin-left: auto;
    margin-right: auto;
    width: 90%;
  }

  .recent-events {
    margin-left: auto;
    margin-right: auto;
    width: 80%;
  }
}
</style>
