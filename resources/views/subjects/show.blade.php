<x-app-layout>
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Subject Details</h2>

    <div class="border-b pb-4 mb-4">
        <p class="text-lg font-semibold">Subject ID: <span class="text-gray-700">{{ $subject->id }}</span></p>
        <p class="text-lg font-semibold">Name: <span class="text-gray-700">{{ $subject->name }}</span></p>
        <p class="text-lg font-semibold">Code: <span class="text-gray-700">{{ $subject->code }}</span></p>
        <p class="text-lg font-semibold">Created On: <span class="text-gray-700">{{ $subject->created_at->format('F d, Y') }}</span></p>
    </div>

    <div class="mt-4">
        <a href="{{ route('subjects.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Back to Subjects</a>
    </div>
</div>
</x-app-layout>
