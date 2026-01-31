<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Create Project
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('projects.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block mb-1">Project Name</label>
                    <input type="text" name="name"
                        class="w-full border rounded p-2"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Description</label>
                    <textarea name="description"
                        class="w-full border rounded p-2">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Status</label>
                    <select name="status" class="w-full border rounded p-2">
                        <option value="">Select Status</option>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>

                    @error('status')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>


                <button type="submit"class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                Save Project
                </button>

            </form>
        </div>
    </div>
</x-app-layout>
