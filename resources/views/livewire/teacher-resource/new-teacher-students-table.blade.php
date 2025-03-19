<div class="p-4 bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Students</h2>
        <input type="text" wire:model.search placeholder="Search..."
               class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring focus:ring-primary-500">
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-200 rounded-lg">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-4 py-3 border-b">Name</th>
                    <th class="px-4 py-3 border-b">Email</th>
                    <th class="px-4 py-3 border-b">Marks</th>
                    <th class="px-4 py-3 border-b">Attendance</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm">
                @forelse ($this->getTableQuery()->paginate(10) as $student)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 border-b">{{ $student->name }}</td>
                        <td class="px-4 py-3 border-b">{{ $student->email }}</td>
                        <td class="px-4 py-3 border-b">
                            @if ($student->marks)
                                @if ($student->marks->isNotEmpty())
                                    {{ $student->marks->first()->mark }}
                                    <a href="{{ route('filament.resources.marks.add-mark', ['studentId' => $student->id]) }}">Add Mark</a>
                                @else
                                    <a href="{{ route('filament.resources.marks.add-mark', ['studentId' => $student->id]) }}">Add Mark</a>
                                @endif
                            @else
                                <a href="{{ route('filament.resources.marks.add-mark', ['studentId' => $student->id]) }}">Add Mark</a>
                            @endif
                        </td>
                        <td class="px-4 py-3 border-b">
                            @if ($student->marks)
                                @if ($student->marks->isNotEmpty())
                                    <button wire:click="toggleAttendance({{ $student->id }})">
                                        {{ $student->marks->first()->attendance ? 'Present' : 'Absent' }}
                                    </button>
                                @else
                                    <button wire:click="toggleAttendance({{ $student->id }})">Absent</button>
                                @endif
                            @else
                                <button wire:click="toggleAttendance({{ $student->id }})">Absent</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-3 text-center text-gray-500">No students found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $this->getTableQuery()->paginate(10)->links() }}
    </div>
</div>