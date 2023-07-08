<template>
  <NavBar />
  <div class="article-page">
    <h1 class="page-title">Articles</h1>
    <div class="filters">
      <input type="text" v-model="searchQuery" placeholder="Rechercher un article" class="search-input" />
      <select v-model="selectedCategory" class="category-select">
        <option value="">Toutes les catégories</option>
        <option v-for="category in categories" :value="category">{{ category }}</option>
      </select>
    </div>
    <div class="article-list">
      <div v-for="article in filteredArticles" :key="article.id" class="article-item">
        <img src="../assets/img/articles/articles.jpg" alt="Article" class="article-image" />
        <!-- Replace with your actual article image -->
        <h2 class="article-title">{{ article.title }}</h2>
        <p class="article-category">Catégorie: {{ article.category }}</p>
        <p class="article-content">{{ article.content }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import NavBar from '../components/NavBar.vue';

export default {
  data() {
    return {
      searchQuery: '',
      selectedCategory: '',
      articles: [
        {
          id: 1,
          title: "Article 1",
          category: "Catégorie 1",
          content: "Contenu de l'article 1"
        },
        {
          id: 2,
          title: "Article 2",
          category: "Catégorie 2",
          content: "Contenu de l'article 2"
        },
        {
          id: 3,
          title: "Article 3",
          category: "Catégorie 1",
          content: "Contenu de l'article 3"
        },
        {
          id: 4,
          title: "Article 1",
          category: "Catégorie 1",
          content: "Contenu de l'article 1"
        },
        {
          id: 5,
          title: "Article 2",
          category: "Catégorie 2",
          content: "Contenu de l'article 2"
        },
        {
          id: 6,
          title: "Article 3",
          category: "Catégorie 1",
          content: "Contenu de l'article 3"
        },
      ],
      categories: ['Catégorie 1', 'Catégorie 2', 'Catégorie 3'] // Replace with your actual categories
    };
  },
  computed: {
    filteredArticles() {
      return this.articles.filter(
        (article) =>
          article.title.toLowerCase().includes(this.searchQuery.toLowerCase()) &&
          (this.selectedCategory === '' || article.category === this.selectedCategory)
      );
    }
  },
  components: {
    NavBar
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

.article-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  grid-gap: 20px;
}

.article-item {
  background-color: #f0f0f0;
  padding: 10px;
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
</style>
