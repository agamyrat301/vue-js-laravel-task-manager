<template>
    <confirm-modal :modal-active="confirmModalActive" @close="confirmModalActive = false">
        <div class="p-2">
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                    Are you sure you want to delete this task?
                </h3>
                <button type="button" @click="deleteTask"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
                <button type="button" @click="confirmModalActive = false"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    No, cancel
                </button>
            </div>
        </div>
    </confirm-modal>

    <div class="container">

        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold">Tasks : {{ tasksCount }}</h1>
            <div class="my-4 inline-flex justify-center w-7/12">
                <VueDatePicker class="mr-4 w-full" v-model="date" model-type="yyyy-dd-MM" range
                    @update:model-value="handleDate" />

                <select v-model="filters.status" @change="filterTasks" class=" border mr-3 border-gray-300 text-gray-900 text-sm rounded-lg
                     focus:ring-blue-500 focus:border-blue-500 block">
                    <option disabled>Choose a status</option>
                    <option value="pending">pending</option>
                    <option value="progress">in progress</option>
                    <option value="done">done</option>
                </select>

                <router-link :to='{ name: "tasks-create" }' class="text-white bg-blue-700 px-10 hover:bg-blue-800 focus:ring-4
                     focus:ring-blue-300
                     font-medium rounded-lg text-sm dark:bg-blue-600 dark:hover:bg-blue-700 
                     focus:outline-none dark:focus:ring-blue-800">Create
                    Task</router-link>
            </div>
        </div>

        <div class="relative overflow-x-auto">
            <div v-if="isLoading">
                <custom-loading />
            </div>
            <table v-else class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            description
                        </th>
                        <th scope="col" class="px-6 py-3">
                            status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            created date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(task, index) in tasks" :key="task.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ index + 1 }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ task.title }}
                        </th>
                        <td class="px-6 py-4">
                            {{ task.description }}
                        </td>
                        <td class="px-6 py-4">
                            {{ task.status }}
                        </td>
                        <td class="px-6 py-4">
                            {{ task.created }}
                        </td>
                        <td class="px-6 py-4 flex">
                            <router-link :to='{ name: "tasks-edit", params: { id: task.id } }'
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</router-link>
                            <button type="button" @click="toggleModal(task.id)" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4
                         focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 
                         mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="w-full justify-center flex" v-if="!isLoading">
                <vue-awesome-paginate :total-items="tasksCount" :items-per-page="10" :max-pages-shown="5"
                    v-model="currentPage" :on-click="onClickHandler" />
            </div>
        </div>
    </div>
</template>

<script>

import { ref, onMounted, reactive } from 'vue';
import axios from '../../axios';
import { useNotification } from "@kyvg/vue3-notification";

export default {
    setup() {
        const tasks = ref([]);
        const tasksCount = ref(0);
        const date = ref(null);

        const isLoading = ref(false);
        const currentPage = ref(1);
        const currentTaskSelected = ref(null);
        const { notify } = useNotification()
        const filters = reactive({
            status: '',
            dates: []
        })

        const confirmModalActive = ref(false)

        const fetchTasks = async (page) => {
            let from = date.value?.[0] ?? '';
            let to = date.value?.[1] ?? '';

            isLoading.value = true;
            try {
                const response = await axios.get(`/tasks?status=${filters.status}&page=${page}&from=${from}&to=${to}`);
                console.log(response.data?.meta?.total, 'response')
                tasksCount.value = response.data?.meta?.total
                tasks.value = response.data?.data;
                isLoading.value = false;
            } catch (error) {
                console.error('Error fetching tasks:', error);
                isLoading.value = false;
            }
        };

        const handleDate = () => {
            fetchTasks(currentPage.value)
        };

        const onClickHandler = () => {
            fetchTasks(currentPage.value)
        };

        const toggleModal = (task_id) => {
            currentTaskSelected.value = task_id
            confirmModalActive.value = true
        }

        const filterTasks = () => {
            fetchTasks(currentPage.value)
        }

        const deleteTask = () => {
            isLoading.value = true;
            axios.delete(`tasks/${currentTaskSelected.value}`).then(resp => {
                console.log(resp.status)
                if (resp.status == 204) {
                    notify({
                        title: "Deletion",
                        type: "warn",
                        text: "task was deleted successfully",
                    });
                    confirmModalActive.value = false
                    currentTaskSelected.value = null
                    fetchTasks()

                }
                isLoading.value = false;

            }).catch(err => {
                alert(JSON.stringify(err))
            })
        }

        onMounted(() => {
            fetchTasks(currentPage.value)
        });
        return {
            tasks,
            isLoading,
            filters,
            tasksCount,
            filterTasks,
            currentPage,
            onClickHandler,
            toggleModal,
            confirmModalActive,
            deleteTask,
            notify,
            date,
            handleDate
        };
    }
}


</script>

<style scoped>
.pagination-container {
    display: flex;
    column-gap: 10px;
}

.paginate-buttons {
    height: 40px;
    width: 40px;
    border-radius: 20px;
    cursor: pointer;
    background-color: rgb(242, 242, 242);
    border: 1px solid rgb(217, 217, 217);
    color: black;
}

.paginate-buttons:hover {
    background-color: #d8d8d8;
}

.active-page {
    background-color: #3498db;
    border: 1px solid #3498db;
    color: white;
}

.active-page:hover {
    background-color: #2988c8;
}
</style>
