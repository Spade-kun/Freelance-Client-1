<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Subject;
use App\Models\Grade;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User */
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        if (!$student && !$user->hasRole('admin')) {
            return view('dashboard', [
                'grades' => collect(),
                'user' => $user,
                'stats' => []
            ])->with('error', 'No student profile found.');
        }

        // Student Grades
        $grades = collect();
        if ($student) {
            $enrollments = Enrollment::where('student_id', $student->id)
                ->whereHas('grade')
                ->with(['grade', 'subject'])
                ->orderBy('enrollment_date', 'desc')
                ->get();

            $grades = $enrollments->groupBy(function ($enrollment) {
                return Carbon::parse($enrollment->enrollment_date)->format('F Y');
            });
        }

        // Admin Stats - Count Over Time
        $stats = [];
        if ($user->hasRole('admin')) {
            $stats = [
                'users' => User::count(),
                'students' => Student::count(),
                'subjects' => Subject::count(),
                'enrollments' => Enrollment::count(),
                'counts_over_time' => [
                    'users' => User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                        ->groupBy('date')->orderBy('date', 'asc')->get(),
                    'students' => Student::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                        ->groupBy('date')->orderBy('date', 'asc')->get(),
                    'subjects' => Subject::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                        ->groupBy('date')->orderBy('date', 'asc')->get(),
                    'enrollments' => Enrollment::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                        ->groupBy('date')->orderBy('date', 'asc')->get(),
                    'grade_averages' => Grade::selectRaw('DATE(created_at) as date, AVG(grade) as avg_grade')
                        ->groupBy('date')
                        ->orderBy('date', 'asc')
                        ->get(),
                ],
            ];
        }

        return view('dashboard', [
            'grades' => $grades,
            'user' => $user,
            'stats' => $stats
        ]);
    }
}
