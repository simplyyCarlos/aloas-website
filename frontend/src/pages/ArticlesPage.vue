<template>
  <NavBar />
  <div class="utility-bar">
    <div class="group-search">
      <label for="search-input" class="search-label">Rechercher un article :</label>
      <div class="search-bar">
        <input type="text" id="search-input" placeholder="Rechercher" class="search-input" />

      </div>
    </div>
    <div class="group-filter">
      <label for="filter-select" class="filter-label">Filtrer par :</label>
      <div class="filter-dropdown">
        <select id="filter-select">
          <option value="all">Adapei</option>
          <option value="news">Aloas</option>
          <option value="events">Aroma</option>
        </select>
      </div>
    </div>
    
  </div>
  <div class="article-page">
    <div class="article-list-container">
      <div class="article-list">
        <Article v-for="index in 40" :key="index" />
      </div>
      <p class="no-article-message">No articles found.</p>
    </div>
  </div>
</template>

<script>
import NavBar from '../components/NavBar.vue';
import Article from '../components/Article.vue';

export default {
  components: {
    NavBar,
    Article,
  },
  data() {
    return {
      showLoginPopup: false,
    };
  },
  methods: {
    toggleLoginPopup() {
      this.showLoginPopup = !this.showLoginPopup;
    },
  },
};
</script>

<style scoped>
.utility-bar {
  display: flex;
  flex-direction: row;
  height: 50px;
  margin: 20px;
  padding: 0 10px;
  justify-content: space-between;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.419);
  align-items: center;
  border-radius: 8px;
}

.group-search {
  display: flex;
  align-items: center;
}

.group-filter {
  display: flex;
  align-items: center;
}

.search-bar {
  display: flex;
  align-items: center;
  background-color: #f2f2f2;
  border-radius: 4px;
  padding: 8px;
}

.search-label {
  margin-right: 8px;
  font-size: 14px;
  color: #333;
}

.search-input {
  flex: 1;
  border: none;
  background-color: transparent;
  outline: none;
  font-size: 14px;
  color: #333;
}

.search-icon {
  margin-left: 8px;
  color: #999;
  cursor: pointer;
}

.search-icon:hover {
  color: #666;
}

.filter-dropdown {
  display: flex;
  align-items: center;
  background-color: #f2f2f2;
  border-radius: 4px;
  padding: 8px;
}

.filter-label {
  margin-right: 8px;
  font-size: 14px;
  color: #333;
}

.filter-dropdown select {
  border: none;
  background-color: transparent;
  outline: none;
  font-size: 14px;
  color: #333;
}

.filter-dropdown select option {
  font-size: 14px;
  color: #333;
}

.filter-dropdown select:focus {
  outline: none;
}

.filter-dropdown::after {
  content: '\f078';
  font-family: 'FontAwesome';
  font-size: 14px;
  color: #999;
  margin-left: 8px;
}

.filter-dropdown:hover::after {
  color: #666;
  cursor: pointer;
}

.article-page {
  margin: 20px;
  padding: 0 10px;
}

.article-list-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  width: 100%;
}

.article-list {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-gap: 20px;
  width: 100%;
}

.no-article-message {
  font-size: 18px;
  text-align: center;
  margin-top: 20px;
}

@media (max-width: 1472px) {
  .article-list {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media (max-width: 1125px) {
  .article-list {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .article-list {
    grid-template-columns: repeat(1, 1fr);
  }
}
</style>
