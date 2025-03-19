@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome, {{ $student->name }}</h1>
        <h2>Your Grades and Attendance</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Marks</th>
                    <th>Attendance</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $student->subject->name }}</td>
                    <td>{{ $student->marks }}</td>
                    <td>{{ $student->attendance ? 'Present' : 'Absent' }}</td>
                </tr>
            </tbody>
        </table>

        <h3>Your Messages</h3>
        <ul>
            <li>No new messages</li>  
        </ul>
    </div>
@endsection
