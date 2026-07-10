@extends('layouts.main')

@section('title', 'Add Student')

@section('content')
    <div class="card">
        <h2>Add a Student</h2>
        <form method="POST" action="{{ route('students.store') }}">
            @csrf
            <label>Student Name</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name') <p class="error">{{ $message }}</p> @enderror

            <label>Math Score</label>
            <input type="number" name="math" min="0" max="100" value="{{ old('math') }}">
            @error('math') <p class="error">{{ $message }}</p> @enderror

            <label>English Score</label>
            <input type="number" name="english" min="0" max="100" value="{{ old('english') }}">
            @error('english') <p class="error">{{ $message }}</p> @enderror

            <label>Science Score</label>
            <input type="number" name="science" min="0" max="100" value="{{ old('science') }}">
            @error('science') <p class="error">{{ $message }}</p> @enderror

            <label>History Score</label>
            <input type="number" name="history" min="0" max="100" value="{{ old('history') }}">
            @error('history') <p class="error">{{ $message }}</p> @enderror

            <button type="submit" class="btn btn-red">Save Student</button>
            <a href="{{ route('students.index') }}" class="btn btn-grey" style="margin-left:10px;">Cancel</a>
        </form>
    </div>
@endsection