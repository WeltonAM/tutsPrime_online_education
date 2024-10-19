<?php

namespace App\Http\Controllers\Api\version1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class CompleteTaskController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Task $task)
    {

        $task->status = $request->status;
        $task->save();

        return response()->json($task);
    }
}