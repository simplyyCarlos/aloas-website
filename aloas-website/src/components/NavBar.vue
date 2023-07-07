<template>
    <div class="navbar">
        <ul>
            <li>Accueil</li>
            <li><router-link to="/articles">Articles</router-link></li>
            <li>Évenements</li>
            <li>A propos</li>
            <li>Nous contacter</li>
        </ul>
    </div>
</template>

<style scoped>

    .navbar {
        background-color: rgb(36, 163, 36);
        height: 100px;
    }
    .navbar ul {
        display: flex;
       justify-content: space-around;
    }

</style>