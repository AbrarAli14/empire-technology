<form action="{{ route('grades.store') }}" method="POST">
    @csrf
    <div>
        <label for="subject">Subject</label>
        <select name="subject_id">
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="student">Student</label>
        <select name="student_id">
            @foreach($students as $student)
                <option value="{{ $student->id }}">{{ $student->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="grade">Grade</label>
        <input type="text" name="grade" required>
    </div>

    <button type="submit">Assign Grade</button>
</form>
