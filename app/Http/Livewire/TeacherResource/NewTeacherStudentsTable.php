<?php

namespace App\Http\Livewire\TeacherResource;

use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class NewTeacherStudentsTable extends Component
{
    use WithPagination;

    public $search = '';

    public function getTableQuery(): Builder
{
    $teacher = auth()->user();

    return Student::query()
        ->whereHas('subjects', function (Builder $subjectQuery) use ($teacher) {
            $subjectQuery->whereHas('teachers', function (Builder $teacherQuery) use ($teacher) {
                $teacherQuery->where('teachers.id', $teacher->id);
            });
        })
        ->where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        })
        ->with('marks'); 
}
    
public function addMark($studentId)
{
    return redirect()->route('filament.admin.resources.marks.pages.add-mark', ['studentId' => $studentId]);
}
    public function toggleAttendance($studentId)
    {
        
        $student = Student::find($studentId);

        if ($student && $student->marks->isNotEmpty()) {
            $mark = $student->marks->first();
            $mark->attendance = !$mark->attendance;
            $mark->save();
        } else {
            $teacher = auth()->user()->teacher;
            $subject = $student->subjects()->first(); 

            if($teacher && $subject){
                \App\Models\Mark::create([
                    'student_id' => $studentId,
                    'subject_id' => $subject->id,
                    'attendance' => true, 
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.teacher-resource.new-teacher-students-table', [
            'students' => $this->getTableQuery()->paginate(10)
        ]);
    }
}