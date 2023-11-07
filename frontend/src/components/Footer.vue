<template>
    <footer class="footer">
      <div class="footer-content">
        <div class="footer-left">
          <p>&copy; 2023 Aloas, Tout droits réservés.</p>
          <p>Information de contact : example@mail.com</p>
        </div>
        <div class="footer-right">
          <h3>Contactez nous :</h3>
          <form @submit.prevent="sendQuestion">
            <input type="text" v-model="name" placeholder="Votre Nom" required />
            <input type="email" v-model="email" placeholder="Votre Email" required />
            <textarea v-model="question" placeholder="Votre Question" required></textarea>
            <button type="submit">Envoyer</button>
          </form>
        </div>
      </div>
    </footer>
  </template>
  
  <script>
  export default {
    data() {
      return {
        name: "",
        email: "",
        question: "",
      };
    },
    methods: {
      sendQuestion() {
        // Logic to send the question via email
        // You can use a library like Axios to make an API call to your backend
        // with the question details (name, email, question)
        console.log("Question submitted:", this.name, this.email, this.question);
        // Reset the form fields
        this.name = "";
        this.email = "";
        this.question = "";
      },
    },
  };
  </script>
  
  <style scoped>
  .footer {
    background-color: #f0f0f0;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
  }
  
  .footer-content {
    display: flex;
    flex-wrap: wrap;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
  }
  
  .footer-left p {
    margin: 0;
    padding: 5px;
  }
  
  .footer-right {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 10px;
    padding: 10px;
  }
  
  .footer-right h3 {
    margin-top: 0;
    margin-bottom: 10px;
  }
  
  .footer-right input,
  .footer-right textarea {
    margin-bottom: 10px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
  }
  
  .footer-right textarea {
    height: 80px;
    resize: vertical;
  }
  
  .footer-right button {
    background-color: #4caf50;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  .footer-right button:hover {
    background-color: #45a049;
  }
  
  @media (min-width: 768px) {
    .footer {
      flex-direction: row;
      justify-content: center;
      align-items: center;
    }
  
    .footer-content {
      justify-content: center;
      align-items: center;
      margin-bottom: 0;
    }
  
    .footer-right {
      align-items: center;
      margin-top: 0;
    }
  
    .footer-right input,
    .footer-right textarea {
      width: 300px;
    }
  }
  </style>
  
  
  
  
  