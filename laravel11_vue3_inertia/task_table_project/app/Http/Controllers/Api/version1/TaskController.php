<?php

namespace App\Http\Controllers\Api\version1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // return Task::all();
        return TaskResource::collection(Task::all());
    }

    public function show(Task $task)
    {
        return TaskResource::make($task);
    }
}
