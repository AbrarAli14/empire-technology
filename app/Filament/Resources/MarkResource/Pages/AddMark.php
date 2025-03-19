<?php

namespace App\Filament\Resources\MarkResource\Pages;

use App\Filament\Resources\MarkResource;
use App\Models\Mark;
use App\Models\Student;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\DB;

class AddMark extends Page
{
    protected static string $resource = MarkResource::class;

    protected static string $view = 'filament.resources.mark-resource.pages.add-mark';

    public $student_id;
    public $subject_id; 
    public $mark; 
    public $attendance; 

    public function mount($studentId)
    {
        $this->student_id = $studentId; 
        $this->mark = ''; 
        $this->attendance = true; 
    }

    protected function getFormSchema(): array
    {
        $student = Student::find($this->student_id);

        if (!$student) {
            abort(404, 'Student not found!');
        }

        $subjects = DB::table('subjects')
            ->join('marks', 'subjects.id', '=', 'marks.subject_id')
            ->where('marks.student_id', $this->student_id)
            ->select('subjects.id', 'subjects.name')
            ->distinct()
            ->get();

        $subjectOptions = $subjects->pluck('name', 'id')->toArray();

        return [
            Select::make('student_id')
                ->options(Student::all()->pluck('name', 'id'))
                ->default($this->student_id)
                ->disabled(),
            Select::make('subject_id')  
                ->options($subjectOptions)
                ->required()
                ->reactive(),  
            TextInput::make('mark')  
                ->numeric()
                ->required()
                ->reactive()  
                ->afterStateUpdated(fn ($state) => $this->mark = $state),  
           
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['student_id'] = $this->student_id;

        return $data;
    }

    protected function getActions(): array
    {
        return [
            CreateAction::make() 
                ->label('Save Mark')
                ->action(function () {
                    $formData = $this->form->getState();

                    if (!$formData['subject_id'] || !$formData['mark']) {
                        $this->notify('error', 'Please select a subject and enter a mark!');
                        return;
                    }

                    Mark::create([
                        'student_id' => $this->student_id,
                        'subject_id' => $formData['subject_id'],
                        'mark' => $formData['mark'],
                        'attendance' => $formData['attendance'] ?? false
                    ]);

                    $this->notify('success', 'Mark added successfully!');
                    return redirect()->route('filament.resources.marks.index'); 
                }),
        ];
    }
}
