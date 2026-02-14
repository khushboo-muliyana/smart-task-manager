<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            My Projects
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @foreach ($projects as $project)
                <div class="bg-white dark:bg-gray-800 p-5 mb-5 rounded-lg shadow border dark:border-gray-700">

                    <!-- Project Title -->
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        {{ $project->name }}
                    </h3>

                    <!-- Description -->
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                        {{ $project->description }}
                    </p>

                    <!-- Tasks -->
                    <div class="mt-4 space-y-2">
                        @forelse($project->tasks as $task)
                            <div class="flex justify-between items-center bg-gray-100 dark:bg-gray-700 p-3 rounded">

                                <!-- Task Info -->
                                <div>
                                   <span class="font-medium
                                        @if($task->status === 'completed') line-through text-gray-400 @endif">
                                        {{ $task->title }}
                                    </span>

                                    <form method="POST" action="{{ route('tasks.updateStatus', $task) }}">
                                    @csrf
                                    @method('PATCH')

                                    <select name="status"
                                            onchange="this.form.submit()"
                                            class="text-xs rounded border-gray-300 focus:ring-blue-500">
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

                               

                        <div class="flex gap-3">

                            <!-- Improve Task -->
                            <form method="POST" action="{{ route('tasks.improve', $task) }}">
                                @csrf
                                <button class="text-purple-600 text-sm hover:underline">
                                    Improve
                                </button>
                            </form>

                            <!-- Delete Task -->
                            <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 text-sm hover:underline">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </div>
                        @empty
                            <p class="text-sm text-gray-500">No tasks yet</p>
                        @endforelse
                    </div>

                    <!-- Add Task -->
                    <form method="POST" action="{{ route('tasks.store', $project) }}" class="mt-4">
                        @csrf
                        <div class="flex gap-2">
                            <input type="text"
                                   name="title"
                                   placeholder="Add a new task..."
                                   class="w-full rounded border p-2 text-sm focus:ring focus:ring-blue-200">

                            <button class="bg-blue-600 text-white px-4 rounded text-sm hover:bg-blue-700">
                                Add
                            </button>
                        </div>

                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </form>

                    <!-- Task Summary -->
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

                    <!-- Progress Bar -->
                    <div class="mt-4">

                        <div class="flex justify-between text-sm mb-1">
                            <span>Progress</span>
                            <span>{{ $project->progress ?? 0 }}%</span>
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3 dark:bg-gray-700">
                            <div class="bg-green-500 h-3 rounded-full transition-all duration-500"
                                style="width: {{ $project->progress ?? 0 }}%">
                            </div>
                        </div>

                    </div>


                    <!-- Project Footer -->
                    <div class="flex justify-between items-center mt-5 pt-3 border-t dark:border-gray-700">

                        <!-- Project Status -->
                        <span
                            class="px-2 py-1 text-xs font-medium rounded
                            @if($project->status === 'pending') bg-yellow-100 text-yellow-700
                            @elseif($project->status === 'in_progress') bg-blue-100 text-blue-700
                            @else bg-green-100 text-green-700
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                        </span>

                        <!-- Actions -->
                        <div class="flex gap-4 items-center">

                                <form method="POST"
                                    action="{{ route('projects.ai.tasks', $project) }}">
                                    @csrf
                                    <button class="bg-purple-600 text-white px-3 py-1 rounded text-sm hover:bg-purple-700">
                                        AI Tasks
                                    </button>
                                </form>

                                <a href="{{ route('projects.edit', $project) }}">
                                    Edit
                                </a>

                                <form method="POST"
                                    action="{{ route('projects.destroy', $project) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button>Delete</button>
                                </form>

                            </div>
                    </div>

                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>
