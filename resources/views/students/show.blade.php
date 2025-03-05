<x-app-layout>
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Student Details</h2>

    <div class="border-b pb-4 mb-4">
        <p class="text-lg font-semibold">Student ID: <span class="text-gray-700">{{ $student->id }}</span></p>
        <p class="text-lg font-semibold">Name: <span class="text-gray-700">{{ "$student->first_name $student->middle_name $student->last_name" }}</span></p>
        <p class="text-lg font-semibold">Email: <span class="text-gray-700">{{ $student->user->email }}</span></p>
        <p class="text-lg font-semibold">Registered On: <span class="text-gray-700">{{ $student->created_at->format('F d, Y') }}</span></p>
    </div>

    <div class="mt-4">
        <a href="{{ route('students.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Back to Students</a>
    </div>
</div>
</x-app-layout>
