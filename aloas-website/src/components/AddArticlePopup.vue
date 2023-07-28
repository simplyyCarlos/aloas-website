<template>
  <div>
    <Button label="Add Article" icon="pi pi-plus" class="add-article-button" @click="showAddArticleModal">Add
      Article</Button>
    <Dialog v-model:visible="isAddArticleModalOpen" :modal="true" :closable="false" :draggable="false" :resizable="false"
      :style="{ width: '400px' }">
      <h2 class="dialog-title">Add Article</h2>
      <form @submit.prevent="addArticle">
        <div class="p-field">
          <label for="title">Title:</label>
          <InputText id="title" v-model="newArticle.title" required />
        </div>
        <div class="p-field">
          <label for="category">Category:</label>
          <Dropdown :options="categories" v-model="selectedCategory" optionLabel="libelle" @change="onCategoryChange" />
        </div>
        <div class="p-field">
          <label for="content">Content:</label>
          <Textarea id="content" v-model="newArticle.content" required />
        </div>
        <div class="p-field dialog-buttons">
          <Button type="submit" label="Add" />
          <Button type="button" label="Cancel" @click="closeAddArticleModal" />
        </div>
      </form>
    </Dialog>
  </div>
</template>
  
<script>
import axios from 'axios';
export default {
  data() {
    return {
      isAddArticleModalOpen: false,
      newArticle: {
        title: '',
        category: '',
        content: '',
      },
      categories : [],
      selectedCategory: '',
    };
  },
  methods: {
    getAllCategories(){
      axios.get('http://localhost:8080/src/api/categoriesApi.php').then((response) => {
        this.categories = response.data;
        console.log(this.categories);
        console.log(response.data);
      }).catch((error) => {
        console.log(error);
      });
    },
    onCategoryChange() {
      this.newArticle.category = this.selectedCategory;
    },
    showAddArticleModal() {
      this.isAddArticleModalOpen = true;
    },
    closeAddArticleModal() {
      this.isAddArticleModalOpen = false;
      this.resetNewArticleForm();
    },
    addArticle() {
      // Make an HTTP POST request to your PHP API
      axios.post("http://localhost:8080/src/api/addArticleApi.php", this.newArticle)
        .then((response) => {
          // Handle the response if needed (e.g., show a success message)
          console.log("Article added successfully!");

          // Emit an event to notify parent components that an article was added
          this.$emit("articleAdded", this.newArticle);

          // Close the modal and reset the form
          this.closeAddArticleModal();
        })
        .catch((error) => {
          console.error("Error adding article:", error);
          // Handle any error that might occur during the request
        });
    },
    resetNewArticleForm() {
      this.newArticle = {
        title: '',
        category: '',
        content: '',
      };
    },
  },
  created() {
    this.getAllCategories();
  },
};
</script>
  
<style scoped>
.add-article-button {
  margin-left: 10px;
}

.dialog-title {
  text-align: center;
}

.dialog-buttons {
  display: flex;
  justify-content: center;
  margin-top: 20px;
  gap: 10px;
}
</style>
  