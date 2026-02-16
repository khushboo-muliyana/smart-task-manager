<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
📁 My Projects Workspace
</h2>
</x-slot>

<div class="py-6">
<div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

{{-- Flash --}}
@if(session('success'))
<div class="mb-4 p-3 rounded bg-green-100 text-green-800">
{{ session('success') }}
</div>
@endif


{{-- ============================= --}}
{{-- EMPTY STATE --}}
{{-- ============================= --}}
@if(!$projects->count())

<div class="bg-white dark:bg-gray-800 rounded-xl shadow p-10 text-center">

<h2 class="text-2xl font-bold mb-3">
🚀 Welcome to LaraFlow AI
</h2>

<p class="text-gray-600 dark:text-gray-300 mb-6">
You haven’t created any projects yet.<br>
Start by creating your first smart project.
</p>

<a href="{{ route('projects.create') }}"
class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-semibold shadow transition">
+ Create Your First Project
</a>

</div>

@else


{{-- ============================= --}}
{{-- PROJECT LOOP --}}
{{-- ============================= --}}
@foreach ($projects as $project)

<div class="bg-white dark:bg-gray-800 p-5 mb-6 rounded-xl shadow border dark:border-gray-700">

{{-- Project Title --}}
<h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
{{ $project->name }}
</h3>

<p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
{{ $project->description }}
</p>


{{-- ================= TASK AREA ================= --}}
<div class="mt-4 space-y-2 max-h-60 overflow-y-auto pr-1">

@forelse($project->tasks as $task)

<div class="flex justify-between items-center bg-gray-100 dark:bg-gray-700 p-3 rounded">

<div class="flex flex-col gap-1">

<span class="font-medium
@if($task->status === 'completed') line-through text-gray-400 @endif">
{{ $task->title }}
</span>

<form method="POST" action="{{ route('tasks.updateStatus', $task) }}">
@csrf
@method('PATCH')

<select name="status"
onchange="this.form.submit()"
class="text-xs rounded border-gray-300">

<option value="pending" @selected($task->status === 'pending')>
Pending
</option>

<option value="in_progress" @selected($task->status === 'in_progress')>
In Progress
</option>

<option value="completed" @selected($task->status === 'completed')>
Completed
</option>

</select>
</form>

</div>


{{-- TASK ACTIONS --}}
<div class="flex gap-3 text-sm">

<form method="POST" action="{{ route('tasks.improve', $task) }}">
@csrf
<button class="text-purple-600 hover:underline">
Improve
</button>
</form>

<form method="POST" action="{{ route('tasks.destroy', $task) }}">
@csrf
@method('DELETE')
<button class="text-red-600 hover:underline">
Delete
</button>
</form>

</div>

</div>

@empty
<p class="text-sm text-gray-500">No tasks yet</p>
@endforelse

</div>


{{-- ADD TASK --}}
<form method="POST" action="{{ route('tasks.store', $project) }}" class="mt-4">
@csrf

<div class="flex gap-2">

<input type="text"
name="title"
placeholder="Add new task..."
class="w-full rounded border p-2 text-sm">

<button class="bg-blue-600 text-white px-4 rounded text-sm hover:bg-blue-700">
Add
</button>

</div>

@error('title')
<p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror

</form>


{{-- SUMMARY --}}
<div class="mt-4 text-sm text-gray-600 dark:text-gray-300 flex gap-4">

<span>
🧾 Total: <strong>{{ $project->tasks_count }}</strong>
</span>

<span>
✅ Completed: <strong>{{ $project->completed_tasks_count }}</strong>
</span>

<span>
⏳ Pending: <strong>{{ $project->pending_tasks_count }}</strong>
</span>

</div>


{{-- PROGRESS BAR --}}
@php
$progress = $project->tasks_count
? round(($project->completed_tasks_count / $project->tasks_count) * 100)
: 0;
@endphp

<div class="mt-3">

<div class="flex justify-between text-sm mb-1">
<span>Progress</span>
<span>{{ $progress }}%</span>
</div>

<div class="w-full bg-gray-200 rounded-full h-3 dark:bg-gray-700">
<div class="bg-green-500 h-3 rounded-full"
style="width: {{ $progress }}%">
</div>
</div>

</div>


{{-- FOOTER --}}
<div class="flex justify-between items-center mt-5 pt-3 border-t dark:border-gray-700">

<span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">
{{ ucfirst(str_replace('_',' ',$project->status)) }}
</span>

<div class="flex gap-4 text-sm">

<form method="POST" action="{{ route('projects.ai.tasks', $project) }}">
@csrf
<button class="bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700">
AI Tasks
</button>
</form>

<a href="{{ route('projects.edit', $project) }}"
class="text-blue-600 hover:underline">
Edit
</a>

<form method="POST" action="{{ route('projects.destroy', $project) }}">
@csrf
@method('DELETE')
<button class="text-red-600 hover:underline">
Delete
</button>
</form>

</div>

</div>

</div>

@endforeach


{{-- ================= PAGINATION ================= --}}
<div class="mt-6">
{{ $projects->links() }}
</div>

@endif

</div>
</div>
</x-app-layout>