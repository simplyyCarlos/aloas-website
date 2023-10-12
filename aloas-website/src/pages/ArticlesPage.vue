<template>
  <NavBar :showLoginPopup="showLoginPopup" @toggle-login-popup="toggleLoginPopup" />
  <LoginPopup :showLoginPopup="showLoginPopup" @toggle-login-popup="toggleLoginPopup" v-if="showLoginPopup" />
  <div class="article-page">
    <h1 class="page-title">Articles</h1>
    <div class="filters">
      <InputText id="title" v-model="searchQuery" placeholder="Rechercher un article" class="search-input" required />
      <Dropdown :options="categories" v-model="selectedCategory" optionLabel="libelle" />
      <AddArticlePopup v-if="isAddArticleModalOpen" @close="closeAddArticleModal" @articleAdded="articleAdded" />
    </div>
    <div class="article-list-container">
      <div v-if="filteredArticles.length === 0">
        <p class="no-article-message">Aucun article trouvé</p>
      </div>
      <div class="article-list" v-else>
        <div v-for="article in filteredArticles" :key="article.id" class="article-item">
          <img src="../assets/img/articles/articles.jpg" alt="Article" class="article-image" />
          <!-- Replace with your actual article image -->
          <h2 class="article-title">{{ article.titre }}</h2>
          <p class="article-category">Catégorie: {{ article.libelle }}</p>
          <p class="article-content">Auteur : {{ article.nom }} {{ article.prenom }}</p>
        </div>
      </div>
    </div>
  </div>
  <Footer />
</template>

<script>
import NavBar from '../components/NavBar.vue';
import AddArticlePopup from '../components/AddArticlePopup.vue';
import Footer from '../components/Footer.vue';
import LoginPopup from '../components/LoginPopup.vue';
import axios from 'axios';

export default {
  data() {
    return {
      showLoginPopup : false,
      isAddArticleModalOpen: true,
      searchQuery: '',
      selectedCategory: { libelle: 'Toutes les categories' },
      articles: [],
      categories: [], // Replace with your actual categories
    };
  },
  computed: {
    filteredArticles() {
      console.log(this.articles);
      return this.articles.filter(
        (article) =>
          article.titre.toLowerCase().includes(this.searchQuery.toLowerCase()) &&
          (this.selectedCategory.libelle === 'Toutes les categories' || article.libelle === this.selectedCategory.libelle)
      );
    }
  },
  methods: {
    async getAllArticles() {
      axios.get('http://localhost:8080/src/api/articlesApi.php').then((response) => {
        this.articles = response.data;
      }).catch((error) => {
        console.log(error);
      });
    },
    getAllCategories() {
      axios.get('http://localhost:8080/src/api/categoriesApi.php').then((response) => {
        this.categories = response.data;
        this.categories.unshift({ libelle: 'Toutes les categories' });
      }).catch((error) => {
        console.log(error);
      });
    },
    showAddArticleModal() {
      this.isAddArticleModalOpen = true;
    },
    closeAddArticleModal() {
      this.isAddArticleModalOpen = false;
    },
    async articleAdded() {
      await this.getAllArticles();
      this.showAddArticleModal();
    },
    toggleLoginPopup () {
        this.showLoginPopup = !this.showLoginPopup;
    },
  },
  components: {
    NavBar,
    AddArticlePopup,
    Footer,
    LoginPopup,
  },
  created() {
    this.getAllCategories();
    this.getAllArticles();
  }
};
</script>

<style scoped>
.article-page {
  margin: 20px;
}

.page-title {
  font-size: 24px;
  margin-bottom: 10px;
}

.filters {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.search-input {
  margin-right: 10px;
  padding: 8px;
  width: 300px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.category-select {
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.article-list-container {
  max-height: 400px; /* Set a fixed maximum height */
  overflow-y: auto; /* Add a vertical scrollbar when content exceeds the height */
}

.article-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  grid-gap: 20px;
  max-height: 400px;
  /* Set the maximum height here */
  overflow-y: auto;
  /* Add a vertical scrollbar when content exceeds the height */
}

.article-item {
  background-color: #f0f0f0;
  padding: 10px;
  border-radius: 4px;
  box-shadow: 0 0 5px #ccc;
  max-width: 250px;
}

.article-title {
  font-size: 18px;
  margin-bottom: 5px;
}

.article-category {
  font-size: 14px;
  margin-bottom: 5px;
}

.article-content {
  font-size: 14px;
  margin-bottom: 0;
}

.article-image {
  width: 100%;
  height: auto;
}

.no-article-message {
  font-size: 18px;
  text-align: center;
  margin-top: 20px;
}
</style>

