<x-app-layout>
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Grade Details</h2>
    <div class="border-b pb-4 mb-4">
        <p class="text-lg font-semibold">Enrollment ID: <span class="text-gray-700">{{ $grade->enrollment->id }}</span></p>
        <p class="text-lg font-semibold">Enrollment Date: <span class="text-gray-700">{{ $grade->enrollment->enrollment_date->format('F d, Y') }}</span></p>
    </div>
    <div class="border-b pb-4 mb-4">
        <p class="text-lg font-semibold">Grade ID: <span class="text-gray-700">{{ $grade->id }}</span></p>
        <p class="text-lg font-semibold">Grade: <span class="text-green-700 font-bold">{{ $grade->grade }}</span></p>
        <p class="text-lg font-semibold">Remarks: <span class="text-gray-700">{{ $grade->remarks }}</span></p>
    </div>

    <div class="border-b pb-4 mb-4">
        <h3 class="text-xl font-bold text-gray-700">Student Information</h3>
        <p class="text-lg font-semibold">Full Name:
            <span class="text-gray-700">
                {{ $grade->enrollment->student->first_name }} {{ $grade->enrollment->student->middle_name }} {{ $grade->enrollment->student->last_name }}
            </span>
        </p>
        <p class="text-lg font-semibold">Email: <span class="text-gray-700">{{ $grade->enrollment->student->user->email }}</span></p>
    </div>

    <div class="border-b pb-4 mb-4">
        <h3 class="text-xl font-bold text-gray-700">Subject Information</h3>
        <p class="text-lg font-semibold">Subject Name: <span class="text-gray-700">{{ $grade->enrollment->subject->name }}</span></p>
        <p class="text-lg font-semibold">Subject Code: <span class="text-gray-700">{{ $grade->enrollment->subject->code }}</span></p>
    </div>

    <div class="mt-4">
        <a href="{{ route('grades.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Back to Grades</a>
    </div>
</div>
</x-app-layout>
