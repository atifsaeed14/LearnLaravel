<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends BaseController
{
    public function index(Request $request)
    {
        // {{base_url}}/v1/tasks?sort=-title
        // {{base_url}}/v1/tasks?sort=title
        // {{base_url}}/v1/tasks?sort=is_done,title
        // {{base_url}}/v1/tasks?filter[is_done]=0
        
        // return response()->json(Task::all());
        // return new TaskCollection(Task::all());
        // return new TaskCollection(Task::paginate());

        $tasks = QueryBuilder::for(Task::class)
                ->allowedFilters('is_done')
                // ->defaultSort('created_at')
                // ->defaultSort('-created_at')
                ->allowedSorts(['title', 'is_done', 'created_at'])
                ->paginate(); 
        return new TaskCollection($tasks);
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
    
    public function update(UpdateTaskRequest $request, Task $task)
    { 
        $validated = $request->validated();

        $task->update($validated);

        return new TaskResource($task);
    }

    public function destroy(Request $request, Task $task) 
    {
        $task->delete();

        return response()->noContent();
    }
}
