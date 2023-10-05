import axios from 'axios';

const apiUrl = 'http://localhost:8080/src/api/';

export const loginUser = async (email, password) => {
  try {
    const response = await axios.get(`${apiUrl}userApi.php`, {
      params: {
        email,
        password,
      },
    });

    if (response.status === 200) {
      return response.data;
    } else if (response.status === 201) {
      throw new Error('Email ou mot de passe incorrect');
    } else {
      throw new Error('Une erreur est survenue');
    }
  } catch (error) {
    console.error(error);
    throw error;
  }
};

// Other API-related functions can be added here
