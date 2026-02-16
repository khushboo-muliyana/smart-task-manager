<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
🗑 Trashed Projects
</h2>
</x-slot>

<div class="py-6">
<div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

{{-- Flash message --}}
@if(session('success'))
<div class="mb-4 p-3 rounded bg-green-100 text-green-800">
{{ session('success') }}
</div>
@endif


{{-- ================= EMPTY STATE ================= --}}
@if(!$projects->count())

<div class="bg-white dark:bg-gray-800 rounded-xl shadow p-10 text-center">

<h2 class="text-2xl font-bold mb-3">
✨ Nothing in Trash
</h2>

<p class="text-gray-600 dark:text-gray-300 mb-6">
You don’t have any deleted projects.<br>
Deleted projects will appear here.
</p>

<a href="{{ route('projects.index') }}"
class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
← Back to Projects
</a>

</div>

@else


{{-- ================= PROJECT CARDS ================= --}}
@foreach($projects as $project)

<div class="bg-white dark:bg-gray-800 p-5 mb-6 rounded-xl shadow border dark:border-gray-700">

{{-- Title --}}
<h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
{{ $project->name }}
</h3>

{{-- Deleted time --}}
<p class="text-sm text-gray-500 mt-1">
Deleted on:
<strong>
{{ $project->deleted_at->format('d M Y, h:i A') }}
</strong>
</p>


{{-- Actions --}}
<div class="flex justify-between items-center mt-4 pt-3 border-t dark:border-gray-700">

<span class="text-xs px-2 py-1 rounded bg-red-100 text-red-700">
Archived
</span>

<form action="{{ route('projects.restore', $project->id) }}" method="POST">
@csrf
@method('PATCH')

<button
class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm shadow">
Restore Project
</button>

</form>

</div>

</div>

@endforeach


{{-- Pagination (optional if you paginate trash) --}}
@if(method_exists($projects, 'links'))
<div class="mt-6">
{{ $projects->links() }}
</div>
@endif

@endif

</div>
</div>
</x-app-layout>