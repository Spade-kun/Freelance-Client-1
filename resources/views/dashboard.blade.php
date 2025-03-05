<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-lg font-semibold">Welcome, {{ Auth::user()->name }}!</p>

                    <!-- User Dashboard -->
                    @role('user')
                        @if(isset($grades) && $grades->isNotEmpty())
                            <h3 class="mt-6 text-xl font-bold">Your Grades</h3>

                            @foreach($grades as $month => $group)
                                <h4 class="mt-4 text-lg font-semibold text-blue-600">{{ $month }}</h4>

                                <div class="overflow-x-auto mt-2">
                                    <table class="w-full text-sm text-left border border-gray-300 shadow-md">
                                        <thead class="bg-gray-100 text-gray-700">
                                            <tr>
                                                <th class="px-4 py-2 border">Subject</th>
                                                <th class="px-4 py-2 border">Grade</th>
                                                <th class="px-4 py-2 border">Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($group as $enrollment)
                                                <tr class="border-b hover:bg-gray-50">
                                                    <td class="px-4 py-2 border">{{ $enrollment->subject->name }}</td>
                                                    <td class="px-4 py-2 border font-semibold text-green-600">{{ $enrollment->grade->grade }}</td>
                                                    <td class="px-4 py-2 border">{{ $enrollment->grade->remarks }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        @else
                            <p class="mt-4 text-gray-600">No grades found.</p>
                        @endif
                    @endrole

                    <!-- Admin Dashboard -->
                    @role('admin')
                        <div class="mt-6 p-4 bg-yellow-50 border-l-4 border-yellow-500">
                            <p class="text-lg font-semibold text-yellow-700">Admin Dashboard</p>
                            <p class="text-gray-700">Manage users, grades, and system settings here.</p>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-6">
                            <div class="bg-blue-100 p-4 rounded-lg shadow-md">
                                <p class="text-lg font-bold text-blue-700">Total Users: {{ $stats['users'] }}</p>
                            </div>
                            <div class="bg-green-100 p-4 rounded-lg shadow-md">
                                <p class="text-lg font-bold text-green-700">Total Students: {{ $stats['students'] }}</p>
                            </div>
                            <div class="bg-purple-100 p-4 rounded-lg shadow-md">
                                <p class="text-lg font-bold text-purple-700">Subjects: {{ $stats['subjects'] }}</p>
                            </div>
                            <div class="bg-yellow-100 p-4 rounded-lg shadow-md">
                                <p class="text-lg font-bold text-yellow-700">Enrollments: {{ $stats['enrollments'] }}</p>
                            </div>
                        </div>

                        <!-- Count Over Time Graph -->
                        <div class="mt-8">
                            <h3 class="text-xl font-bold">Count Over Time</h3>
                            <canvas id="countOverTimeChart"></canvas>
                        </div>
                        <div class="mt-8">
                            <h3 class="text-xl font-bold">Average Grade Over Time</h3>
                            <canvas id="gradeAverageChart"></canvas>
                        </div>
                    @endrole
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    @role('admin')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx = document.getElementById('countOverTimeChart').getContext('2d');
            var gax = document.getElementById('gradeAverageChart').getContext('2d');

            var countData = {
                labels: @json($stats['counts_over_time']['users']->pluck('date')->toArray()),
                datasets: [
                    {
                        label: 'Users',
                        data: @json($stats['counts_over_time']['users']->pluck('count')->toArray()),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        tension: 0.3
                    },
                    {
                        label: 'Students',
                        data: @json($stats['counts_over_time']['students']->pluck('count')->toArray()),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        tension: 0.3
                    },
                    {
                        label: 'Enrollments',
                        data: @json($stats['counts_over_time']['enrollments']->pluck('count')->toArray()),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        tension: 0.3
                    }
                ]
            };
            var gradeAverageData = {
                labels: @json($stats['counts_over_time']['grade_averages']->pluck('date')->toArray()),
                datasets: [{
                    label: 'Average Grade',
                    data: @json($stats['counts_over_time']['grade_averages']->pluck('avg_grade')->toArray()),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    tension: 0.3
                }]
            };


            new Chart(ctx, {
                type: 'line',
                data: countData,
                options: {
                    responsive: true,
                    scales: { y: { beginAtZero: true } }
                }
            });
            new Chart(gax, {
                type: 'line',
                data: gradeAverageData,
                options: {
                    responsive: true,
                    scales: { y: { beginAtZero: true } }
                }
            });
        });
    </script>
    @endrole
</x-app-layout>
