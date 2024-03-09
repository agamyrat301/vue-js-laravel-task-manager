import './bootstrap';

import {createApp} from 'vue'
import Navbar from './components/Navbar.vue';
import taskCreate from './components/Tasks/create.vue';
import taskIndex from './components/Tasks/index.vue';
import taskEdit from './components/Tasks/edit.vue';
import Loading from './components/Loading.vue';
import ConfirmModal from './components/Modal.vue';

import router from "./router";

import App from './App.vue'

import VueAwesomePaginate from "vue-awesome-paginate";
import Notifications from '@kyvg/vue3-notification'

import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

import "vue3-snackbar/styles";

// import the necessary css file

const app = createApp(App).use(router).use(VueAwesomePaginate).use(Notifications);

app.component('navbar', Navbar);
app.component('tasks-create', taskCreate);
app.component('tasks-index', taskIndex);
app.component('tasks-edit', taskEdit);
app.component('custom-loading', Loading);
app.component('confirm-modal', ConfirmModal);
app.component('VueDatePicker', VueDatePicker);

app.mount('#app');
