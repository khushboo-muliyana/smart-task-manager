<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Services\AiService;


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

        $project->updateProgress();
        return back()->with('success', 'Task added successfully!');
    }

        public function destroy(Task $task)
    {
        $project = $task->project; 

        $task->delete();

        $project->updateProgress();

        return back()->with('success', 'Task deleted successfully!');
    }

        public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task->update([
            'status' => $request->status,
        ]);

        $task->project->updateProgress();

        return back()->with('success', 'Task status updated!');
    }

            public function restore($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);

        $project = $task->project;

        $task->restore();

        $project->updateProgress();

        return back()->with('success', 'Task restored');
    }

        public function trashed()
    {
        // Get only soft-deleted tasks
        $tasks = Task::onlyTrashed()->get();

        return view('tasks.trashed', compact('tasks'));
    }
    public function improve(Task $task, AiService $ai)
    {
        $project = $task->project;

        $improved = $ai->improveTask(
            $project->name,
            $project->description,
            $task->title
        );

        // Clean + limit text
        $improved = trim(strip_tags($improved));
        $improved = substr($improved, 0, 200);

        $task->update([
            'title' => $improved
        ]);

        return back()->with('success', 'Task improved by AI!');
    }

}
