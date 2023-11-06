<script setup>
import { ref, onMounted } from 'vue';
import Footer from '../components/Footer.vue';
import NavBar from '../components/NavBar.vue';
import LoginPopup from '../components/LoginPopup.vue';
import { mapState, mapActions } from 'vuex';

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
        <!-- Article list content here -->
      </div>
    </div>
    <aside class="recent-events">
      <h2 class="section-title">Événements à venir</h2>
      <div class="event-list-wrapper">
        <ul class="event-list">
          <li v-for="(event) in nextEvents">
            <div class="card">
              <div class="card-header">{{ event.title }}</div>
              <div class="card-body">
                <p>{{ handleDate(event.start, event.end) }}</p>
                <p>{{ handleLocation(event.location) }}</p>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </aside>
  </main>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      showLoginPopup: false,
      articles: [],
    };
  },
  components: { LoginPopup },
  computed: {
    ...mapState(["events"]),
    nextEvents() {
      const nextEvents = [];
      this.events.forEach(event => {
        const baseEvent = {
          title: event.eventName,
          start: event.eventStartDate,
          end: event.eventEndDate,
          location: event.eventLocation,
          description: event.eventDescription,
          IsRepeatedWeekly: event.eventIsRepeatedWeekly,
        };
        nextEvents.push(baseEvent);
        if (event.eventIsRepeatedWeekly) {
          const startDate = new Date(event.eventStartDate);
          const endDate = new Date(event.eventEndDate);
          const oneWeek = 7 * 24 * 60 * 60 * 1000; // One week in milliseconds

          for (let i = 1; i <= 52; i++) { // Repeat for one year (52 weeks)
            const newStart = new Date(startDate.getTime() + i * oneWeek);
            const newEnd = new Date(endDate.getTime() + i * oneWeek);

            const recurrEvent = {
              id: `${event.id}-repeated-${i}`,
              title: event.eventName,
              start: newStart.toISOString(),
              end: newEnd.toISOString(),
              allDay: event.eventIsAllDay,
              extendedProps: {
                location: event.eventLocation,
                description: event.eventDescription,
                eventIsRepeatedWeekly: true,
              },
            };
            nextEvents.push(recurrEvent);
          }
        }
      });
      return nextEvents;
    }
  },
  methods: {
    ...mapActions(['fetchEvents']),
    async fetchEventsFromApi() {
      try {
        await this.fetchEvents();
      } catch (error) {
        console.error(error);
      }
    },
    handleLocation(location) {
      switch (location) {
        case "cosec_favier":
          return "Cosec Favier";
        case "dojo_montagnat":
          return "Dojo de Montagnat";
        case "ceyzeriat_petanque":
          return "Terrain de pétanque Ceyzériat";
        case "adapei":
          return "ADAPEI";
      }
    },
    handleDate(dateStart, dateEnd) {
      const convertedStartDate = new Date(dateStart);
      const convertedEndDate = new Date(dateEnd);

      const weekdays = [
        "Dimanche",
        "Lundi",
        "Mardi",
        "Mercredi",
        "Jeudi",
        "Vendredi",
        "Samedi",
      ];

      const months = [
        "janvier",
        "février",
        "mars",
        "avril",
        "mai",
        "juin",
        "juillet",
        "août",
        "septembre",
        "octobre",
        "novembre",
        "décembre",
      ];

      const startDay = weekdays[convertedStartDate.getDay()];
      const startDayNumber = convertedStartDate.getDate();
      const startMonth = months[convertedStartDate.getMonth()];
      const startTime = convertedStartDate.toLocaleTimeString("fr-FR", {
        hour: "2-digit",
        minute: "2-digit",
      });

      const endDay = weekdays[convertedEndDate.getDay()];
      const endDayNumber = convertedEndDate.getDate();
      const endMonth = months[convertedEndDate.getMonth()];
      const endTime = convertedEndDate.toLocaleTimeString("fr-FR", {
        hour: "2-digit",
        minute: "2-digit",
      });

      if (startDay === endDay && startDayNumber === endDayNumber && startMonth === endMonth) {
        // If the end date is the same day as the start date
        return `${startDay} ${startDayNumber} ${startMonth} à ${startTime}h jusqu'à ${endTime}h`;
      } else {
        // If the end date is a different day
        return `${startDay} ${startDayNumber} ${startMonth} à ${startTime}h jusqu'au ${endDay} ${endDayNumber} ${endMonth}${endTime}h`;
      }
    },
    toggleLoginPopup() {
      this.showLoginPopup = !this.showLoginPopup;
    },
    async getAllArticles() {
      axios.get('http://localhost:8080/src/api/articlesLimitApi.php').then((response) => {
        this.articles = response.data;
      }).catch((error) => {
        console.log(error);
      });
    },
  },
  created() {
    this.getAllArticles();
  },
  mounted() {
    this.fetchEventsFromApi();
    console.log(this)
  },
};
</script>

<style scoped>
.carousel {
  position: relative;
  overflow: hidden;
  height: 30rem;
  z-index: 0;
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
  height: 100%;
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
  top: calc(50% - 20px);
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

.hero-section {
  background-color: #dddddd;
  background-size: cover;
  background-position: center;
  padding: 50px 0;
}

.hero-content {
  color: black;
  padding: 20px;
}

.hero-title {
  font-size: 32px;
  margin-bottom: 20px;
}

.hero-paragraph {
  font-size: 16px;
  margin-bottom: 0;
}

.container {
  position: relative;
  display: grid;
  grid-template-columns: 2fr 1fr;
  grid-gap: 50px;
  margin-top: -50px;
  z-index: 2;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  grid-template-rows: repeat(3, auto);
}

.recent-articles {
  margin-bottom: 20px;
  margin-left: 25%;
  height: 700px;
  min-height: 600px;
  background-color: #ffffff;
  border-radius: 1%;
  box-shadow: 0.5px 0.5px 0.5px 1px rgba(0, 0, 0, 0.315);
}

.section-title {
  font-size: 24px;
  margin-bottom: 10px;
  padding: 20px;
}

.article-list {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-gap: 20px;
  padding: 20px;
}

.article-item {
  background-color: #f0f0f0;
  padding: 10px;
  border-radius: 4px;
  box-shadow: 0 0 5px #ccc;
  max-width: 250px;
}

.article-image {
  width: 100%;
  height: auto;
}

.article-title {
  margin: 0;
}

.article-title a {
  color: #000;
  text-decoration: none;
}

.recent-events {
  background-color: #ffffff;
  padding: 10px;
  width: 70%;
  min-height: 600px;
  height: 700px;
  border-radius: 2%;
  box-shadow: 0.5px 0.5px 0.5px 1px rgba(0, 0, 0, 0.315);
}

.event-list-wrapper {
  max-height: 400px; /* Set a fixed maximum height for the container */
  overflow-y: auto; /* Enable vertical scrolling when content overflows */
  padding-right: 10px; /* Add some right padding to avoid content being hidden under the scrollbar */
}

.event-list {
  padding: 0;
  margin: 0;
  list-style: none;
}

.card {
  background-color: rgba(95, 197, 95, 0.8);
  border-radius: 10px;
  padding: 20px;
  margin-bottom: 20px;
  color: white;
  border-radius: 8px;
  box-shadow: 0 0 5px #ccc;
}

@media (max-width: 1050px) {
  .carousel {
    height: 18rem;
  }
}

@media (max-width: 768px) {
  .container {
    grid-template-columns: repeat(1, minmax(0, 1fr));
    justify-items: center;
    align-items: center;
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

  .control-button {
    padding: 5px;
    font-size: 20px;
  }

  .article-list {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .article-item {
    font-size: 12px;
    margin-bottom: 20px;
  }
}
</style>
