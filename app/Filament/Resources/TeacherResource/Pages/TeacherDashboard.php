<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use Filament\Resources\Pages\Page;

class TeacherDashboard extends Page
{
    protected static string $resource = TeacherResource::class;
    protected static ?string $navigationLabel = 'My Dashboard';
    protected static ?string $navigationGroup = 'Teacher';
    protected static string $view = 'filament.resources.teacher-resource.pages.teacher-dashboard';



}
