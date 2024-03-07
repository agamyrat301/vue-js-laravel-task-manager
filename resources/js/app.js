import './bootstrap';

import {createApp} from 'vue'
import Navbar from './components/Navbar.vue';
import taskCreate from './components/Tasks/create.vue';
import taskIndex from './components/Tasks/index.vue';

import router from "./router";


import App from './App.vue'

const app = createApp(App).use(router);

// createApp(App).mount("#app")

app.component('navbar', Navbar);
app.component('tasks-create', taskCreate);
app.component('tasks-index', taskIndex);
app.mount('#app');
