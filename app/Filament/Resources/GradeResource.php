<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GradeResource\Pages;
use App\Filament\Resources\GradeResource\RelationManagers;
use App\Models\Grade;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GradeResource extends Resource
{
    protected static ?string $model = Grade::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    public static function canViewAny(): bool
    {
        return Filament::auth()->user()->hasRole('admin') || Filament::auth()->user()->hasRole('teacher');
    }
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Select::make('teacher_id')
                ->relationship('teacher', 'name')
                ->preload()
                ->required(),
            Select::make('student_id')
                ->relationship('student', 'name')
                ->preload()
                ->required(),
            Select::make('subject_id')
                ->relationship('subject', 'name')
                ->preload()
                ->required(),
            TextInput::make('marks')
                ->numeric()
                ->minValue(0)
                ->maxValue(100)
                ->required(),
            Textarea::make('remarks')->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.name')->label('Student'),
                TextColumn::make('teacher.name')->label('Teacher'),
                TextColumn::make('subject.name')->label('Subject'),
                TextColumn::make('marks')->sortable(),
                TextColumn::make('remarks')->wrap(),
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
            'index' => Pages\ListGrades::route('/'),
            'create' => Pages\CreateGrade::route('/create'),
            'edit' => Pages\EditGrade::route('/{record}/edit'),
        ];
    }    
}
