<x-app-layout>
    <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    📊 Dashboard Analytics
                </h2>

                <a href="{{ route('projects.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg text-sm font-semibold shadow transition">
                    + New Project
                </a>
            </div>
    </x-slot>

    <div class="py-10 bg-gradient-to-br from-slate-50 to-indigo-50 dark:from-gray-900 dark:to-gray-950 min-h-screen">

        <div class="max-w-7xl mx-auto px-6">

            <!-- Greeting -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Welcome back, {{ Auth::user()->name }} 👋
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Here’s your productivity snapshot today.
                </p>
            </div>

            <!-- Analytics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

                <!-- Projects -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                    <p class="text-gray-500 text-sm">Total Projects</p>
                    <h2 class="text-3xl font-bold mt-2">{{ $totalProjects }}</h2>
                </div>

                <!-- Tasks -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                    <p class="text-gray-500 text-sm">Total Tasks</p>
                    <h2 class="text-3xl font-bold mt-2">{{ $totalTasks }}</h2>
                </div>

                <!-- Completed -->
                <div class="bg-emerald-100 dark:bg-emerald-900/30 p-6 rounded-2xl shadow-md">
                    <p class="text-emerald-700 dark:text-emerald-400 text-sm">Completed</p>
                    <h2 class="text-3xl font-bold mt-2 text-emerald-800 dark:text-emerald-300">
                        {{ $completedTasks }}
                    </h2>
                </div>

                <!-- Progress -->
                <div class="bg-indigo-100 dark:bg-indigo-900/30 p-6 rounded-2xl shadow-md">
                    <p class="text-indigo-700 dark:text-indigo-400 text-sm">Success Rate</p>
                    <h2 class="text-3xl font-bold mt-2 text-indigo-800 dark:text-indigo-300">
                        {{ $progress }}%
                    </h2>
                </div>

            </div>

            <!-- Progress Section -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-md mb-10">

                <div class="flex justify-between mb-3">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        Overall Progress
                    </h3>

                    <span class="font-bold text-indigo-600">
                        {{ $progress }}%
                    </span>
                </div>

                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4 overflow-hidden">
                    <div class="bg-indigo-600 h-4 rounded-full transition-all duration-700"
                         style="width: {{ $progress }}%">
                    </div>
                </div>

                <p class="mt-3 text-gray-500 dark:text-gray-400">
                    {{ $pendingTasks }} tasks remaining — keep going 🚀
                </p>

            </div>

            <!-- Actions -->
            <div class="flex flex-wrap gap-4">

                <a href="{{ route('projects.index') }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-semibold shadow transition">
                    View Projects
                </a>

                <a href="{{ route('projects.create') }}"
                   class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl font-semibold shadow transition">
                    Create Project
                </a>

                <a href="{{ route('projects.trashed') }}"
                   class="bg-gray-200 hover:bg-red-100 text-gray-700 px-6 py-3 rounded-xl font-semibold shadow transition">
                    Archive
                </a>

            </div>

        </div>

    </div>
</x-app-layout>