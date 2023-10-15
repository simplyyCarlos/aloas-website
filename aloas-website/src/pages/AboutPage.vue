<template>
    <NavBar />
    <div class="title-box">
        <h1>À propos de ALOAS</h1>
    </div>
    <div class="about-page">
        <div class="about-sections">
            <div class="about-section">
                <h2>Qui nous sommes</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sit amet purus in odio consequat
                    tincidunt.</p>
                <img src="../assets/img/articles/articles.jpg" alt="ImageSection" class="section-image" />

            </div>
            <div class="about-section">
                <h2>Où nous agissons</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sit amet purus in odio consequat
                    tincidunt.</p>
                <img src="../assets/img/articles/articles.jpg" alt="ImageSection" class="section-image" />

            </div>
            <div class="about-section">
                <h2>Pour qui</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sit amet purus in odio consequat
                    tincidunt.</p>
                <img src="../assets/img/articles/articles.jpg" alt="ImageSection" class="section-image" />

            </div>
            <div class="about-section">
                <h2>Quand</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sit amet purus in odio consequat
                    tincidunt.</p>
                <img src="../assets/img/articles/articles.jpg" alt="ImageSection" class="section-image" />

            </div>
        </div>
    </div>
    <Footer />
</template>

  
<script>
import NavBar from '../components/NavBar.vue';
import Footer from '../components/Footer.vue';

export default {
    components: {
        NavBar,
        Footer
    }
};
</script>
  
<style scoped>
.about-page {
    margin: 20px;
    background-color: #f5f5f5;
    /* Fond gris clair */
}

.about-sections {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    /* Deux sections par ligne */
    gap: 20px;
    padding: 20px;
}

.about-section {
    background-color: #fff;
    /* Fond blanc pour chaque section */
    border-radius: 10px;
    /* Arrondi */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    /* Ombre */
    padding: 20px;
}

.section-image {
    width: 100%;
    border-radius: 10px;
    /* Arrondi pour les images */
}

.title-box {
    background-color: #f5f5f5;
    /* Fond gris clair */
    padding: 20px;
    margin: 20px;
    border-radius: 10px;
    /* Arrondi */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    /* Ombre */
}

h1 {
    font-size: 24px;
    margin-bottom: 10px;
    text-align: center;
}

h2 {
    font-size: 20px;
    margin: 10px 0;
}

p {
    font-size: 14px;
    margin: 0;
}
</style>
  