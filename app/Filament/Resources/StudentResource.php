<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use App\Models\Subject;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'School Management';

    protected static ?string $navigationLabel = 'Students';
    public static function canViewAny(): bool
    {
        return Filament::auth()->user()->hasRole('admin') || Filament::auth()->user()->hasRole('student');
    }
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')->required(),
            TextInput::make('email')->email()->required(),
            TextInput::make('password')
                ->password()
                ->required()
                ->dehydrateStateUsing(fn ($state) => \Illuminate\Support\Facades\Hash::make($state)),
            Select::make('subjects')
                ->multiple()
                ->relationship('subjects', 'name')
                ->preload()
                ->required(),
        ]);

    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')->label('Student Name'),
            Tables\Columns\TextColumn::make('grades.marks')->label('Marks')
                ->formatStateUsing(fn ($state) => $state ?: 'No grades assigned'),
        
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('subject')->options(Subject::all()->pluck('name', 'id')),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }    
}
