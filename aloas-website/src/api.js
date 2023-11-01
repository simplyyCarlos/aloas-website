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

export const addEvent = async (eventName, eventStartDate, eventEndDate, eventIsAllDay, eventIsRepeatedWeekly, eventLocation, eventDescription) => {
  try {
    const response = await axios.post(`${apiUrl}addEventApi.php`, {
      eventName,
      eventStartDate,
      eventEndDate,
      eventIsAllDay,
      eventIsRepeatedWeekly,
      eventLocation,
      eventDescription,
    });

    if (response.status === 200) {
      return response.data;
    } else {
      throw new Error('Failed to add the event');
    }
  } catch (error) {
    console.error(error);
    throw error;
  }
};

export const getEvents = async () => {
  try {
    const response = await axios.get(`${apiUrl}getEventsApi.php`);
    if (response.status === 200) {
      return response.data;
    } else {
      throw new Error('Failed to get events');
    }
  } catch (error) {
    console.error(error);
    throw error;
  }
};

export const deleteEvent = async (eventId) => {
  try{
    const response = await axios.post(`${apiUrl}deleteEventApi.php`, {
      eventId,
    });
    
    if(response.status ===200){
      return response.data;
    }else{
      throw new Error('Failed to delete the event');
    }
  }catch(error){
    console.error(error);
    throw error;
  }
}