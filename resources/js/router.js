import { createWebHistory, createRouter } from "vue-router";
import TasksIndex from "./components/Tasks/index.vue";
import TasksCreate from "./components/Tasks/create.vue";
import TasksEdit from "./components/Tasks/edit.vue";

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
    {
        path: "/tasks/:id/edit",
        name: "tasks-edit",
        component: TasksEdit,
        props:true
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
