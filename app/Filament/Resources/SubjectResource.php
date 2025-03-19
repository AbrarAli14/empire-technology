<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubjectResource\Pages;
use App\Models\Subject;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;

use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    public static function canViewAny(): bool
    {
        return Filament::auth()->user()->hasRole('admin');
    }
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')
                ->label('Subject Name')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Subject Name')
                    ->searchable(),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSubjects::route('/'),
            'create' => Pages\CreateSubject::route('/create'),
            'edit' => Pages\EditSubject::route('/{record}/edit'),
        ];
    }  
    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-collection';
    }

    public static function getLabel(): string
    {
        return 'Subject';
    }

    public static function getPluralLabel(): string
    {
        return 'Subjects';
    }  
}
