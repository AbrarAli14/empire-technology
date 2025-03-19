<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required',
            'student_id' => 'required',
            'grade' => 'required',
        ]);

        Grade::create([
            'subject_id' => $request->subject_id,
            'student_id' => $request->student_id,
            'grade' => $request->grade,
        ]);

        return redirect()->route('teacher.dashboard');
    }
}
