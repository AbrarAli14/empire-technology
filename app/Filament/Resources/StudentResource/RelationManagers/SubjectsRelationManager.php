<?php

namespace App\Filament\Resources\StudentResource\RelationManagers;


use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SubjectsRelationManager extends RelationManager
{
    protected static string $relationship = 'subjects';

    protected static ?string $recordTitleAttribute = 'name';


    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'School Management';
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
            TextColumn::make('name'),
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
    
   
    
   
    public function getRelations(): BelongsToMany
    {
        return $this->ownerRecord->subjects();
    }

    }
