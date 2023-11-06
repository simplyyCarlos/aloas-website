<template>
    <main class="article-container">
      <div class="vertical-container">
        <div class="article-img">
          <img src="..\assets\img\activities\judo.jpeg" alt="Article Image">
        </div>
        <div class="article-title">
          <h1>Création du site Internet !</h1>
        </div>
        <div class="article-body">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo dolores rem sint quo repellendus aliquid saepe nihil beatae ea doloribus ... ... ... laborum, quia tempora! Corrupti iusto esse deserunt! Voluptas, laboriosam reiciendis.</p>
          <p>A temporibus, architecto id optio, nisi neque dolor necessitatibus, numquam sequi laborum consequuntur ... ... ... officiis? Perspiciatis, dolores magnam! Odit, eveniet! Eos impedit rem rerum inventore esse suscipit modi non autem alias! Similique quidem ratione quo adipisci, minima quas. Dignissimos ... ... ... doloremque culpa, consequatur sequi laborum voluptatum labore sint, hic minima obcaecati eum dicta beatae sunt ipsam officia vero molestiae ducimus exercitationem quos.</p>
        </div>  
      </div>
      <p class="author-info">Auteur: Jules Valette</p>
    </main>
  </template>
  
  <script>
  export default {
    // Component logic goes here
  };
  </script>
  
  <style>
  .article-container {
    padding: 20px;
    width: 100%;
    max-width: 500px;
    height: auto;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.419);
    position: relative;
  }
  
  .vertical-container {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  
  .article-title {
    border-bottom: 6px solid #4caf50;
    margin: 20px 0;
    font-size:15px;
  }
  
  .article-body {
    text-align: justify;
  }
  
  .article-body p {
    margin-bottom: 10px;
  }
  
  .article-img {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 8px;
  }
  
  .article-img img {
    width: 100%;
    height: auto;
    border-radius: 8px;
  }
  
  .author-info {
    position: absolute;
    bottom: 10px;
    right: 10px;
    font-size: 14px;
    color: grey;
  }
  
  @media (max-width: 768px) {
    .article-container {
      max-width: 100%;
    }
  }
  </style>
  