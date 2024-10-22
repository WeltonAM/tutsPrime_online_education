<?php

namespace App\Http\Controllers\Api\version2;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Task::class);

        $usersTasks = auth()
            ->user()
            // ->handleSort(request()->query('sort_by') ?? 'time')
            ->tasks()
            ->with('priority')
            ->get();

        return TaskResource::collection($usersTasks);
    }

    public function store(StoreTaskRequest $request)
    {
        if(request()->user()->cannot('create', Task::class)) {
            abort(403, "Unauthorized");
        }

        $task = $request->user()->tasks()->create($request->validated());

        $task->load('priority');

        return TaskResource::make($task);
    }

    public function show(Task $task)
    {
        Gate::authorize('view', $task);

        $task->load('priority');

        return TaskResource::make($task);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        if($request->user()->cannot('update', $task)) {
            abort(403, "Unauthorized");
        }

        $task->update($request->validated());

        $task->load('priority');

        return TaskResource::make($task);
    }

    public function destroy(Task $task)
    {
        if(request()->user()->cannot('delete', $task)) {
            abort(403, "Unauthorized");
        }

        $task->delete();

        return response()->noContent();
    }
}
