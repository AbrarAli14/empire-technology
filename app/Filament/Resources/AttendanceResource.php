<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceResource\Pages;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Subject;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;

class AttendanceResource extends Resource
{

    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'School Management';
    
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Select::make('student_id')
                ->label('Student')
                ->options(function () {
                    if (!Auth::user()->teacher) {
                        return \App\Models\Student::pluck('name', 'id'); 
                    }

                    return \App\Models\Student::whereHas('subjects', function ($query) {
                        $query->whereHas('teachers', function ($teacherQuery) {
                            $teacherQuery->where('teachers.id', Auth::user()->teacher->id);
                        });
                    })->pluck('name', 'id');
                })
                ->required(),
            Select::make('subject_id')
                ->label('Subject')
                ->options(function () {
                    if (!Auth::user()->teacher) {
                        return \App\Models\Subject::pluck('name', 'id');
                    }

                    return \App\Models\Subject::whereHas('teachers', function ($query) {
                        $query->where('teachers.id', Auth::user()->teacher->id);
                    })->pluck('name', 'id');
                })
                ->required(),
            TextInput::make('attendance_date')
                ->type('date')
                ->default(now()->format('Y-m-d'))
                ->label('Attendance Date')
                ->required(),
            Select::make('is_present')
                ->options([
                    1 => 'Present',
                    0 => 'Absent',
                ])
                ->default(1)
                ->label('Attendance Status'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                ->sortable(),
            Tables\Columns\TextColumn::make('subject.name')
                ->sortable(),
            Tables\Columns\TextColumn::make('attendance_date')
                ->date()
                ->sortable(),
            Tables\Columns\IconColumn::make('is_present')
                ->boolean()
                ->label('Present'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttendances::route('/'),
            'create' => Pages\CreateAttendance::route('/create'),
            'edit' => Pages\EditAttendance::route('/{record}/edit'),
        ];
    } 
    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user() && (Auth::user()->hasRole(['admin', 'teacher']));
    }

    public static function canViewAny(): bool
    {
        return Auth::user() && (Auth::user()->hasRole(['admin', 'teacher']));
    }   
}
