<?php

namespace App\Filament\Resources\TeacherResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SubjectsRelationManager extends RelationManager
{
    protected static string $relationship = 'subjects'; // Change this

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Select::make('id')
                ->relationship('subjects', 'name')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
      
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name'),
        ])
        ->filters([
            //
        ])
        ->headerActions([
            Tables\Actions\AttachAction::make(),
        ])
        ->actions([
            Tables\Actions\DetachAction::make(),
        ])
        ->bulkActions([
            
        ]);
    
    }
    
    public function getRelations(): BelongsToMany //add this function
    {
        return $this->ownerRecord->subjects();
    }
    
   

    }
