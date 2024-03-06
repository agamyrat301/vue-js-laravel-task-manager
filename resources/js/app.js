import './bootstrap';

import {createApp} from 'vue'
import Navbar from './components/Navbar.vue';


import App from './App.vue'

const app = createApp(App);

// createApp(App).mount("#app")

app.component('navbar', Navbar);
app.mount('#app');
