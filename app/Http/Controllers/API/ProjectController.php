<?php

namespace App\Http\Controllers\API;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        // return new ProjectCollection(Auth::user()->projects()->paginate());

        // {{base_url}}/v1/projects
        // {{base_url}}/v1/projects?include=tasks
        // {{base_url}}/v1/tasks?sort=is_done,title
        // {{base_url}}/v1/tasks?filter[is_done]=0

        $project = QueryBuilder::for(Project::class)
                    ->allowedIncludes('tasks')
                    // ->allowedFilters('tasks')
                    // ->defaultSort('created_at')
                    // ->defaultSort('-created_at')
                    // ->allowedSorts(['title', 'is_done', 'created_at'])
                    ->paginate(); 
        return new ProjectCollection($project);
    }

    public function show(Request $request, Project $project)
    {
        // return new ProjectResource($project);
        return (new ProjectResource($project))->load('tasks');
    }

    public function store(ProjectStoreRequest $request)
    {
        $validated = $request->validated();

        $project = Auth::user()->projects()->create($validated);

        return new ProjectResource($project);
    }

    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $validated = $request->validated();

        $project->update($validated);

        return new ProjectResource($project);
    }

    public function destroy(Request $request, Project $project)
    {
        $project->delete();

        return response()->noContent();
    }
}
