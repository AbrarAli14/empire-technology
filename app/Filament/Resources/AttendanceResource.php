<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceResource\Pages;
use App\Filament\Resources\AttendanceResource\RelationManagers;
use App\Models\Attendance;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

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
            DatePicker::make('date')->required(),
            Radio::make('status')
                ->options([
                    'present' => 'Present',
                    'absent' => 'Absent',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
}
