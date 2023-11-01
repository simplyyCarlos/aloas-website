<script setup>
import NavBar from '../components/NavBar.vue';
</script>

<template>
    <NavBar/>
    <div class="main-page">
        <div class="contact-component">
            <form action="" class="contact-form">
                <h2>Formulaire de Contact</h2>
                <div class="form-group">
                    <label for="first-name">Prénom</label>
                    <input type="text" id="first-name" name="first-name" required>
                </div>
                <div class="form-group">
                    <label for="last-name">Nom</label>
                    <input type="text" id="last-name" name="last-name" required>
                </div>
                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <div class="button-container">
                    <button type="submit">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
    
  </template>
  
  <style scoped>
    .main-page {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 80vh;
    }
    .contact-component {
      width: 50%;
      min-width: 295px;
      max-width: 560px;
     
    }
  
    .contact-form {
      width: 100%;
      max-width: 600px;
      background-color: white;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.419);
    }
    .contact-form h2 {
        text-align: center;
        width: auto;
        margin-bottom: 20px;
        border-bottom: 6px solid #4caf50;

    }
  
    .form-group {
      display: flex;
      flex-direction: column;
      margin-bottom: 20px;
    }
  
    label {
      font-weight: bold;
      margin-bottom: 5px;
    }
  
    input,
    textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #4caf50;
      border-radius: 5px;
      font-size: 16px;
      resize: none;
      transition: border-color 0.3s, box-shadow 0.3s;
    }
  
    input:focus,
    textarea:focus {
      outline: none;
      border-color: #4caf50;
      box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
    }

    .button-container button {
        width: 100%;
        padding: 10px;
        border: 1px solid #4caf50; 
        border-radius: 5px;
        font-size: 16px;
        background-color: #4caf50; /* Set a background color for the button */
        color: white; /* Text color for the button */
        cursor: pointer; /* Add a pointer cursor on hover */
        transition: background-color 0.3s, border-color 0.3s, box-shadow 0.3s, color 0.3s;
    }

    .button-container button:hover {
        background-color: white;
        color: #4caf50;
        border-color: #4caf50;
    }

    /* Style for button when focused */
    .button-container button:focus {
        outline: none;
        box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
    }
  </style>
  