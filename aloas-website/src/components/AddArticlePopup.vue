<template>
    <button class="add-article-button" @click="showAddArticleModal">Add Article</button>
    <div class="modal" :class="{ 'modal-open': isAddArticleModalOpen }">
        <div class="modal-content">
            <h2>Add Article</h2>
            <form @submit.prevent="addArticle">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" v-model="newArticle.title" required />
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <input type="text" id="category" v-model="newArticle.category" required />
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea id="content" v-model="newArticle.content" required></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit">Add</button>
                    <button type="button" @click="closeAddArticleModal">Cancel</button>
                </div>
            </form>
        </div>
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
                content: ''
            }
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
            this.closeAddArticleModal();
        },
        resetNewArticleForm() {
            this.newArticle = {
                title: '',
                category: '',
                content: ''
            };
        }
    },
};
</script>

<style scoped>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    display: none;
    justify-content: center;
    align-items: center;
}

.modal-open {
    display: flex;
}

.modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 4px;
}

.form-group {
    margin-bottom: 10px;
}

textarea {
    height: 100px;
}

.form-actions {
    margin-top: 20px;
}

.form-actions button {
    margin-right: 10px;
}

.add-article-button{
  margin-left: 10px;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #fff;
  cursor: pointer;
}
</style>