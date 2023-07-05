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
  <Footer />
</template>

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
</style>
