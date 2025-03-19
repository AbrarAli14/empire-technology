<?php

namespace App\Filament\Resources\AttendanceResource\Pages;

use App\Filament\Resources\AttendanceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateAttendance extends CreateRecord
{
    protected static string $resource = AttendanceResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['teacher_id'] = Auth::user()->teacher->id;
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function mount(?int $subject_id = null, ?int $teacher_id = null): void
    {
        if ($subject_id) {
            $this->form->fill(['subject_id' => $subject_id]);
        }
        if ($teacher_id) {
            $this->form->fill(['teacher_id' => $teacher_id]);
        }
    }}
