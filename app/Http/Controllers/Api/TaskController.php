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
        $from = $request->get('from');
        $to = $request->get('to');
        $status = $request->get('status');

        if ($status) {

            switch ($request->get('status')) {
                case 'pending':
                    $tasks->where('status', 'pending');
                    break;
                case 'progress':
                    $tasks->where('status', 'progress');
                    break;
                case 'done':
                    $tasks->where('status', 'done');
                    break;

                default:
                    break;
            }
        }

        if($from !== null){
            $tasks->where('created_at', '<=',$from);
        }

        if($to !== null){
            $tasks->where('created_at', '>=',$to);
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
