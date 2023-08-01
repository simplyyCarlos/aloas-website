<template>
    <div class="error-dialog">
      <i class="fas fa-exclamation-triangle"></i>
      <p>{{ errorMessage }}</p>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      errorMessage: {
        type: String,
        required: true,
      },
    },
  };
  </script>
  
  <style scoped>
  .error-dialog {
    display: flex;
    align-items: center;
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    border: 1px solid #f5c6cb;
    border-radius: 5px;
  }
  
  .error-dialog i {
    margin-right: 10px;
    color: #721c24;
  }
  
  .error-dialog p {
    margin: 0;
  }
  </style>
  