<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function index()
    {
        // Get the current student (assuming the student is logged in)
        $student = auth()->user()->student;

        return view('student.dashboard', compact('student'));
    }
}
