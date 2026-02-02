<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $project->tasks()->create([
            'title' => $request->title,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Task added successfully!');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return back()->with('success', 'Task deleted successfully!');
    }
}
