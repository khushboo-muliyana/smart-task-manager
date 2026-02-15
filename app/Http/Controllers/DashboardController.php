<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $totalProjects = Project::where('user_id', $userId)->count();

        $totalTasks = Task::whereHas('project', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->count();

        $completedTasks = Task::where('status', 'completed')
            ->whereHas('project', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })->count();

        $pendingTasks = Task::where('status', 'pending')
            ->whereHas('project', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })->count();

        $progress = $totalTasks > 0
            ? round(($completedTasks / $totalTasks) * 100)
            : 0;

        return view('dashboard', compact(
            'totalProjects',
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'progress'
        ));
    }
}