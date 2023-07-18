<template>
    <div>
      <Button label="Add Article" icon="pi pi-plus" class="add-article-button" @click="showAddArticleModal">Add Article</Button>
      <Dialog v-model:visible="isAddArticleModalOpen" :modal="true" :closable="false" :draggable="false" :resizable="false" :style="{ width: '400px' }">
        <h2 class="dialog-title">Add Article</h2>
        <form @submit.prevent="addArticle">
          <div class="p-field">
            <label for="title">Title:</label>
            <InputText id="title" v-model="newArticle.title" required />
          </div>
          <div class="p-field">
            <label for="category">Category:</label>
            <InputText id="category" v-model="newArticle.category" required />
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
  export default {
    data() {
      return {
        isAddArticleModalOpen: false,
        newArticle: {
          title: '',
          category: '',
          content: '',
        },
      };
    },
    methods: {
      showAddArticleModal() {
        this.isAddArticleModalOpen = true;
      },
      closeAddArticleModal() {
        this.isAddArticleModalOpen = false;
        this.resetNewArticleForm();
      },
      addArticle() {
        // Perform the logic to add the article to your data collection
        // You can access the values from `this.newArticle` object
        // After adding the article, you can close the modal and reset the form
        this.$emit('articleAdded', this.newArticle);
        this.closeAddArticleModal();
      },
      resetNewArticleForm() {
        this.newArticle = {
          title: '',
          category: '',
          content: '',
        };
      },
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
  