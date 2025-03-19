<x-filament::page>
    <div class="p-6 bg-white shadow rounded-lg">
        <h1 class="text-2xl font-semibold text-gray-700 mb-4">My Subjects and Marks</h1>

        @php
            $marks = $this->getStudentMarks();
        @endphp

        @if ($marks->isNotEmpty())
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-200 rounded-lg shadow-sm">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-sm font-semibold">
                        <tr>
                            <th class="px-6 py-3 text-left border-b">Subject</th>
                            <th class="px-6 py-3 text-left border-b">Mark</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                        @foreach ($marks as $mark)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-3 border-b">{{ $mark->subject->name }}</td>
                                <td class="px-6 py-3 border-b font-medium">{{ $mark->mark }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-4 text-center text-gray-500">
                <p>No marks found.</p>
            </div>
        @endif
    </div>
</x-filament::page>
