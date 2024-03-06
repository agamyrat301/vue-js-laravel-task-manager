<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tasks = [
            [
                'title' => 'Task 1',
                'description' => 'Description of Task 1',
                'status' => 0, // Pending
            ],
            [
                'title' => 'Task 2',
                'description' => 'Description of Task 2',
                'status' => 1, // In Progress
            ],
            [
                'title' => 'Task 3',
                'description' => 'Description of Task 3',
                'status' => 2, // Done
            ],
            [
                'title' => 'Task 4',
                'description' => 'Description of Task 3',
                'status' => 0, // Done
            ],
            [
                'title' => 'Task 5',
                'description' => 'Description of Task 3',
                'status' => 0, // Done
            ],
            [
                'title' => 'Task 6',
                'description' => 'Description of Task 3',
                'status' => 0, // Done
            ],
            [
                'title' => 'Task 7',
                'description' => 'Description of Task 3',
                'status' => 0, // Done
            ],
            [
                'title' => 'Task 8',
                'description' => 'Description of Task 3',
                'status' => 2, // Done
            ],
            [
                'title' => 'Task 9',
                'description' => 'Description of Task 3',
                'status' => 2, // Done
            ],
            [
                'title' => 'Task 10',
                'description' => 'Description of Task 3',
                'status' => 2, // Done
            ],
            [
                'title' => 'Task 11',
                'description' => 'Description of Task 3',
                'status' => 2, // Done
            ],
            [
                'title' => 'Task 12',
                'description' => 'Description of Task 3',
                'status' => 2, // Done
            ],
            [
                'title' => 'Task 13',
                'description' => 'Description of Task 3',
                'status' => 2, // Done
            ],
            [
                'title' => 'Task 14',
                'description' => 'Description of Task 3',
                'status' => 2, // Done
            ],
            [
                'title' => 'Task 15',
                'description' => 'Description of Task 3',
                'status' => 2, // Done
            ],
            [
                'title' => 'Task 16',
                'description' => 'Description of Task 3',
                'status' => 2, // Done
            ],
            [
                'title' => 'Task 17',
                'description' => 'Description of Task 3',
                'status' => 2, // Done
            ],
            [
                'title' => 'Task 18',
                'description' => 'Description of Task 3',
                'status' => 2, // Done
            ],
            [
                'title' => 'Task 19',
                'description' => 'Description of Task 3',
                'status' => 2, // Done
            ],
            [
                'title' => 'Task 20',
                'description' => 'Description of Task 3',
                'status' => 2, // Done
            ],

        ];

        foreach ($tasks as $taskData) {
            Task::create($taskData);
        }

    }
}
