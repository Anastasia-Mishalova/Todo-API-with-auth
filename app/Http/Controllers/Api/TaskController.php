<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::select('title', 'description', 'status')->orderBy('created_at', 'desc')->get();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|string|in:pending,in_progress,done',
        ]);

        $task = Task::create($request->only(['title', 'description', 'status']));
        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //оставила find, а не findOrFail, чтобы ошибка при неправильном id была нагляднее
        $task = Task::find($id);
        if (!$task) {
            return response()->json('Task not found', 404);
        }
        
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json('Task not found', 404);
        }
        $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|nullable|string',
            'status' => 'sometimes|required|string|in:pending,in_progress,done',
        ]);

        $task->update($request->only(['title', 'description', 'status']));
        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json('Task not found', 404);
        }

        $task->delete();
        return response()->json(null, 204);
    }
}
