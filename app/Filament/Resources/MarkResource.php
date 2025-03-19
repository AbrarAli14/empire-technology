<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarkResource\Pages;
use App\Models\Mark;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;

class MarkResource extends Resource
{
    protected static ?string $model = Mark::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'School Management';

   

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('student_id')->relationship('student', 'name'),
                Select::make('subject_id')->relationship('subject', 'name'),
                Select::make('grade_id')->relationship('grade', 'name')->nullable(),
                TextInput::make('mark')->numeric(),
                Toggle::make('attendance'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')->label('student.name'),
                Tables\Columns\TextColumn::make('subject.name'),
                Tables\Columns\TextColumn::make('mark'),
           
            ])
            ->filters([
                
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
            'index' => Pages\ListMarks::route('/'),
            'edit' => Pages\EditMark::route('/{record}/edit'),
            'add-mark' => Pages\AddMark::route('/add-mark/{studentId}')

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
