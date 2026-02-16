<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
➕ Create Project
</h2>
</x-slot>

<div class="py-10">

<div class="max-w-3xl mx-auto">

<div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-8">

<h3 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">
New Project
</h3>

<form method="POST" action="{{ route('projects.store') }}">
@csrf


{{-- Project Name --}}
<div class="mb-6">
<label class="block font-medium mb-2">
Project Name
</label>

<input type="text"
name="name"
value="{{ old('name') }}"
class="w-full border rounded-lg p-3 focus:ring focus:ring-blue-200 dark:bg-gray-900 dark:border-gray-600">

@error('name')
<p class="text-red-500 text-sm mt-1">
{{ $message }}
</p>
@enderror
</div>


{{-- Description --}}
<div class="mb-6">
<label class="block font-medium mb-2">
Description (optional)
</label>

<textarea name="description"
rows="4"
class="w-full border rounded-lg p-3 focus:ring focus:ring-blue-200 dark:bg-gray-900 dark:border-gray-600">{{ old('description') }}</textarea>
</div>


{{-- Buttons --}}
<div class="flex justify-between items-center mt-8">

<a href="{{ route('projects.index') }}"
class="text-gray-600 hover:text-gray-800">
← Cancel
</a>

<button type="submit"
class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg shadow">
Save Project
</button>

</div>

</form>

</div>

</div>

</div>
</x-app-layout>