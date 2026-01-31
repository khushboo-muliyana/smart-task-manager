<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Edit Project
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('projects.update', $project) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1">Project Name</label>
                    <input type="text" name="name"
                        value="{{ old('name', $project->name) }}"
                        class="w-full border rounded p-2">
                    @error('name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Description</label>
                    <textarea name="description"
                        class="w-full border rounded p-2">{{ old('description', $project->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Status</label>
                    <select name="status" class="w-full border rounded p-2">
                        @foreach(['pending','in_progress','completed'] as $status)
                            <option value="{{ $status }}"
                                {{ old('status', $project->status) === $status ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_',' ', $status)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
                    Update Project
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
