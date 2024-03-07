import { createWebHistory, createRouter } from "vue-router";
import TasksIndex from "./components/Tasks/index.vue";
import TasksCreate from "./components/Tasks/create.vue";

const routes = [
    {
        path: "/",
        name: "tasks-index",
        component: TasksIndex,
    },
    {
        path: "/tasks/create",
        name: "tasks-create",
        component: TasksCreate,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
