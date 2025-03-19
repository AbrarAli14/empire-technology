@extends('filament::page')

@section('content')
    <h2>Your Grades</h2>

    @foreach ($grades as $grade)
        <div>
            <p>{{ $grade->subject->name }}: {{ $grade->grade }}</p>
        </div>
    @endforeach
@endsection
