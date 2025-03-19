<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarkResource\Pages;
use App\Filament\Resources\MarkResource\Pages\CreateMark;
use App\Filament\Resources\MarkResource\Pages\EditMark;
use App\Filament\Resources\MarkResource\Pages\ListMarks;
use App\Filament\Resources\MarkResource\RelationManagers;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Filament\Facades\Filament;
use Filament\Forms;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MarkResource extends Resource
{
    protected static ?string $model = Mark::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    public static function canViewAny(): bool
    {
        return Filament::auth()->user()->hasRole('admin') || Filament::auth()->user()->hasRole('teacher');
    }
    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('student_id')
                ->label('Student')
                ->options(Student::all()->pluck('name', 'id'))
                ->required(),

            Select::make('subject_id')
                ->label('Subject')
                ->options(Subject::all()->pluck('name', 'id'))
                ->required(),

            TextInput::make('marks')
                ->label('Marks')
                ->required()
                ->numeric(),
        ]);
    }
    
    

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('student.name')->label('Student'),
            Tables\Columns\TextColumn::make('subject.name')->label('Subject'),
            Tables\Columns\TextColumn::make('marks')->label('Marks'),
            
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
            'index' => Pages\ListMarks::route('/'),
            'create' => Pages\CreateMark::route('/create'),
            'edit' => Pages\EditMark::route('/{record}/edit'),
        ];
    }    
}
