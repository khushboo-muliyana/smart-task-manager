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
                                    <p class="font-medium text-gray-900 dark:text-gray-100">
                                        {{ $task->title }}
                                    </p>

                                    <!-- Task Status -->
                                    <span
                                        class="inline-block mt-1 px-2 py-0.5 text-xs rounded
                                        @if($task->status === 'pending') bg-yellow-100 text-yellow-700
                                        @elseif($task->status === 'in_progress') bg-blue-100 text-blue-700
                                        @else bg-green-100 text-green-700
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                </div>

                                <!-- Delete Task -->
                                <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 text-sm hover:underline">
                                        Delete
                                    </button>
                                </form>
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
                        <div class="flex gap-4">
                            <a href="{{ route('projects.edit', $project) }}"
                               class="text-sm text-indigo-600 hover:underline">
                                Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('projects.destroy', $project) }}"
                                  onsubmit="return confirm('Delete this project?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-sm text-red-600 hover:underline">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>
