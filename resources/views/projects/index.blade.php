<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            My Projects
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Flash Success Message --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Project List --}}
        @foreach ($projects as $project)
        <div class="bg-white dark:bg-gray-800 p-4 mb-4 rounded-lg shadow-sm border dark:border-gray-700">

            <!-- Title -->
            <h5 class="text-lg font-semibold mb-1 text-gray-900 dark:text-gray-100">
                {{ $project->name }}
            </h5>

            <!-- Description -->
            <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">
                {{ $project->description }}
            </p>

            <!-- Footer -->
            <div class="flex justify-between items-center">

                <!-- Status -->
                <span
                    class="px-2 py-1 text-xs font-medium rounded
                    @if($project->status === 'pending') bg-yellow-100 text-yellow-700
                    @elseif($project->status === 'in_progress') bg-blue-100 text-blue-700
                    @else bg-green-100 text-green-700
                    @endif">
                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                </span>

                <!-- Actions -->
                <div class="flex items-center gap-4">

                    <!-- Edit -->
                    <a href="{{ route('projects.edit', $project) }}"
                    class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                        Edit
                    </a>

                    <!-- Delete -->
                    <form action="{{ route('projects.destroy', $project) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this project?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="text-sm font-medium text-red-600 hover:text-red-800">
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
