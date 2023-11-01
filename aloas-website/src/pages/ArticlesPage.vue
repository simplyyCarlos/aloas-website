<template>
  <NavBar :showLoginPopup="showLoginPopup" @toggle-login-popup="toggleLoginPopup" />
  <LoginPopup :showLoginPopup="showLoginPopup" @toggle-login-popup="toggleLoginPopup" v-if="showLoginPopup" />
  <div class="article-page">
    <h1 class="page-title">Actualités</h1>
    <div class="filters">
      <InputText id="title" v-model="searchQuery" placeholder="Rechercher un article" class="search-input" required />
      <Dropdown :options="categories" v-model="selectedCategory" optionLabel="libelle" />
      <div v-if="isAuthenticated">
        <AddArticlePopup v-if="isAddArticleModalOpen" @close="closeAddArticleModal" @articleAdded="articleAdded" />
      </div>
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
  
</template>

<script>
import NavBar from '../components/NavBar.vue';
import AddArticlePopup from '../components/AddArticlePopup.vue';
import Footer from '../components/Footer.vue';
import LoginPopup from '../components/LoginPopup.vue';
import axios from 'axios';
import { mapState, mapActions } from 'vuex';

export default {
  data() {
    return {
      showLoginPopup: false,
      isAddArticleModalOpen: true,
      searchQuery: '',
      selectedCategory: { libelle: 'Toutes les categories' },
      articles: [],
      categories: [], // Replace with your actual categories
    };
  },
  computed: {
    filteredArticles() {
      return this.articles.filter(
        (article) =>
          article.titre.toLowerCase().includes(this.searchQuery.toLowerCase()) &&
          (this.selectedCategory.libelle === 'Toutes les categories' || article.libelle === this.selectedCategory.libelle)
      );
    },
    ...mapState(["isAuthenticated", "user"]),
  },
  methods: {
    async getAllArticles() {
      axios
        .get('http://localhost:8080/src/api/articlesApi.php')
        .then((response) => {
          this.articles = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getAllCategories() {
      axios
        .get('http://localhost:8080/src/api/categoriesApi.php')
        .then((response) => {
          this.categories = response.data;
          this.categories.unshift({ libelle: 'Toutes les categories' });
        })
        .catch((error) => {
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
    toggleLoginPopup() {
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
  },
};
</script>

<style scoped>
.article-page {
  margin: 20px;
  padding: 0 10px;
}

.page-title {
  font-size: 24px;
  margin-bottom: 10px;
  text-align: center;
  background-color: #f5f5f5;
  /* Fond gris clair */
  padding: 20px;
  margin: 20px;
  border-radius: 10px;
  /* Arrondi */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  /* Ombre */
  text-align: center;
}

.filters {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 10px;
  background-color: #f5f5f5;
  /* Fond gris clair */
  padding: 20px;
  margin: 20px;
  border-radius: 10px;
  /* Arrondi */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  /* Ombre */
  text-align: center;
}

.search-input {
  margin-bottom: 10px;
  padding: 8px;
  width: 100%;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.category-select {
  padding: 8px;
  width: 100%;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-bottom: 10px;
}

.article-list-container {
  max-height: 400px;
  overflow-y: auto;
  padding: 0 10px;
}

.article-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  grid-gap: 20px;
  max-height: 400px;
  overflow-y: auto;
}

.article-item {
  background-color: #f0f0f0;
  padding: 10px;
  border-radius: 4px;
  box-shadow: 0 0 5px #ccc;
  max-width: 250px;
  width: 100%;
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

@media screen and (max-width: 768px) {
  .article-list {
    grid-template-columns: repeat(1, minmax(0, 1fr));
  }

  .article-list-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0 10px;
    max-width: 1200px;
    margin: 0 auto;
  }

  .filters {
    width: 100%;
  }

  .search-input {
    width: 100%;
  }

  .category-select {
    width: 100%;
  }

  .article-item {
    max-width: 100%;
  }
}</style>
