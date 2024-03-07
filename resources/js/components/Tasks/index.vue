<template>
<div class="container">

    <div class="flex justify-between items-center">
        <h1>Tasks</h1>
        <div class="my-4">
            <router-link :to='{name:"tasks-create"}' class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create Task</router-link>
        </div>
    </div>


    <div class="relative overflow-x-auto">
        {{tasks?.length}}

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Product name
                </th>
                <th scope="col" class="px-6 py-3">
                    Color
                </th>
                <th scope="col" class="px-6 py-3">
                    Category
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="task in tasks" :key="task.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{task.title}}
                </th>
                <td class="px-6 py-4">
                    Silver
                </td>
                <td class="px-6 py-4">
                    Laptop
                </td>
                <td class="px-6 py-4">
                    $2999
                </td>
            </tr>

            </tbody>
        </table>
    </div>

</div>
</template>

<script>

import { ref, onMounted } from 'vue';
import axios from '../../axios'


export default {
    setup(){
        const tasks = ref([]);

        const fetchTasks = async () => {
            try {
                const response = await axios.get('/tasks');
                console.log(response.data?.data,'RESPONSE')
                tasks.value = response.data?.data;
            } catch (error) {
                console.error('Error fetching tasks:', error);
            }
        };

        onMounted(fetchTasks);
        return {
            tasks,
        };
    }
}


</script>

<style scoped>

</style>
