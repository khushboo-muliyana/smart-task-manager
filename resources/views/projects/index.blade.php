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
                <div class="bg-white dark:bg-gray-800 p-4 mb-3 rounded shadow">
                    <h5 class="text-lg font-bold">
                        {{ $project->name }}
                    </h5>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ $project->description }}
                    </p>
                    <span class="text-sm text-blue-600">
                        {{ $project->status }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
