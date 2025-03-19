<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function showGrades()
    {
        $grades = Grade::where('student_id', Auth::id())->get();

        return view('student.grades', compact('grades'));
    }
}
