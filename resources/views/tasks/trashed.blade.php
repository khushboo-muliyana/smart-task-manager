<x-app-layout>

<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
🗑 Trashed Tasks
</h2>
</x-slot>

<div class="py-6">
<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

{{-- Success message --}}
@if(session('success'))
<div class="mb-5 p-4 rounded-xl bg-green-100 text-green-800 shadow">
{{ session('success') }}
</div>
@endif


{{-- EMPTY STATE --}}
@if($tasks->isEmpty())

<div class="bg-white dark:bg-gray-800 p-10 rounded-2xl shadow text-center">

<div class="text-5xl mb-3">🧹</div>

<h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">
No trashed tasks
</h3>

<p class="text-gray-500 dark:text-gray-400">
Deleted tasks will appear here.
</p>

</div>

@else


{{-- TASK LIST --}}
<div class="space-y-4">

@foreach($tasks as $task)

<div class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow border dark:border-gray-700 flex justify-between items-center">

<div>

<h3 class="font-semibold text-gray-800 dark:text-gray-200">
{{ $task->title }}
</h3>

<p class="text-sm text-gray-500 mt-1">
Deleted: {{ $task->deleted_at->format('d M Y, H:i') }}
</p>

</div>


{{-- Restore button --}}
<form action="{{ route('tasks.restore', $task->id) }}" method="POST">
@csrf
@method('PATCH')

<button
class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow transition">
♻ Restore
</button>

</form>

</div>

@endforeach

</div>

@endif

</div>
</div>

</x-app-layout>