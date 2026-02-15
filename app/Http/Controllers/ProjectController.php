<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Services\AiService;

class ProjectController extends Controller
{
                public function index()
        {
            $projects = Project::where('user_id', auth()->id())
                ->with('tasks') 
                ->withCount([
                    'tasks',
                    'tasks as completed_tasks_count' => function ($query) {
                        $query->where('status', 'completed');
                    },
                    'tasks as pending_tasks_count' => function ($query) {
                        $query->where('status', 'pending');
                    }
                ])
                ->get();

            return view('projects.index', compact('projects'));
        }


        public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Project::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'status' => 'pending', 
            'progress' => 0,
        ]);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project created successfully!');
    }

        public function edit(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        return view('projects.edit', compact('project'));
    }

        public function update(Request $request, Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $project->update($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project updated successfully!');
    }

        public function destroy(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project deleted successfully!');
    }

        public function restore($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->route('projects.index')
            ->with('success', 'Project restored successfully');
    }

        public function trashed()
    {
        // Get only soft-deleted projects
        $projects = Project::onlyTrashed()->get();

        return view('projects.trashed', compact('projects'));
    }

        public function generateAiTasks(Project $project, AiService $ai)
    {
        // $response = $ai->generateTasks($project);
        $response = $ai->generateTasks($project->name, $project->description);
        // Split AI text into lines
        $lines = preg_split('/\r\n|\r|\n/', $response);

        foreach ($lines as $line) {

            // Clean formatting
            $clean = trim(
                preg_replace('/^[\d\-\*\.\s]+/', '', strip_tags($line))
            );

            // Skip junk lines
            if(strlen($clean) < 5) continue;
            if(str_contains(strtolower($clean), 'here are')) continue;

            // Save task
            $project->tasks()->create([
                'title' => $clean,
                'status' => 'pending',
            ]);
        }

        $project->updateProgress();
        return back()->with('success', 'AI tasks generated!');
    }
}
