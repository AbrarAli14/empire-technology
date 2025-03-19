<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;

class StudentDashboard extends Page
{
    protected static string $resource = StudentResource::class;

    protected static string $view = 'filament.resources.student-resource.pages.student-dashboard';
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';
    protected static ?string $navigationLabel = 'My Dashboard';
    protected static ?string $navigationGroup = 'Student';

    public function mount(): void
    {
        if (!Auth::user()->student) {
            abort(403, 'Unauthorized access.');
        }
    }

    public function getStudentMarks()
    {
        $student = Auth::user()->student;
        return $student->marks()->with('subject')->get();
    }
}
