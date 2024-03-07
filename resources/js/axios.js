import axios from 'axios';

const instance = axios.create({
    baseURL: 'http://localhost:8000/api', // Set your base URL here
    timeout: 10000, // Set your timeout
    // Add other default configurations here
});

export default instance;
