<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\Task as TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::query();
        if ($request->has('status') && !empty($request->get('status'))) {

            switch ($request->get('status')) {
                case 0:
                    $tasks->where('status', 0);
                    break;
                case 1:
                    $tasks->where('status', 1);
                    break;
                case 2:
                    $tasks->where('status', 2);
                    break;

                default:
                    $tasks->where('status', 0);
                    break;
            }
        }

        return TaskResource::collection($tasks->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()], 400);
        }

        $task = Task::create($request->all());
        return (new TaskResource($task))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Task $task, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()], 400);
        }
        $task->update($request->all());
        return (new TaskResource($task))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();
            return response()->json('task deleted', 204);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => $th->getMessage()], 500);
        }
        //
    }
}
