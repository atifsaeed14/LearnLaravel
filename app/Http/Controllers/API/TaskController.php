<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends BaseController
{
    public function index(Request $request)
    {
        // return response()->json(Task::all());
        return new TaskCollection(Task::all());
    }

    public function show(Request $request, Task $task)
    {
        return new TaskResource($task);
    }

    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();

        $task = Task::create($validated);

        return new TaskResource($task);
    }
    
}
