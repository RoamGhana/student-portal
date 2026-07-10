@extends('layouts.main')

@section('title', 'All Students')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">All Students</h2>
        <a href="{{ route('students.create') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 text-sm">+ Add Student</a>
    </div>

    <form method="GET" action="{{ route('students.index') }}" class="flex gap-3 mb-6">
        <input type="text" id="search-input" name="search" placeholder="Search by name..."
            value="{{ request('search') }}"
            class="border border-gray-300 rounded px-3 py-2 text-sm flex-1">
        <select id="filter-select" name="filter" class="border border-gray-300 rounded px-3 py-2 text-sm">
            <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All Students</option>
            <option value="passing" {{ request('filter') == 'passing' ? 'selected' : '' }}>Passing (50+)</option>
            <option value="failing" {{ request('filter') == 'failing' ? 'selected' : '' }}>Failing (below 50)</option>
        </select>
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded text-sm hover:bg-red-700">Search</button>
        <a href="{{ route('students.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded text-sm hover:bg-gray-500">Clear</a>
    </form>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($students->isEmpty())
        <div class="empty">No students found.</div>
    @else
        <table>
            <tr>
                <th>Name</th>
                <th>Math</th>
                <th>English</th>
                <th>Science</th>
                <th>History</th>
                <th>Average</th>
                <th>Letter</th>
                <th>Actions</th>
            </tr>
            @foreach($students as $student)
            <tr class="student-row" data-name="{{ $student->name }}" data-average="{{ $student->average }}">
                <td>{{ $student->name }}</td>
                <td>{{ $student->math }}</td>
                <td>{{ $student->english }}</td>
                <td>{{ $student->science }}</td>
                <td>{{ $student->history }}</td>
                <td>{{ $student->average }}</td>
                <td>
                    @if($student->average >= 90) A
                    @elseif($student->average >= 75) B
                    @elseif($student->average >= 60) C
                    @elseif($student->average >= 50) D
                    @else F
                    @endif
                </td>
                <td class="actions">
                    <a href="{{ route('students.edit', $student) }}" class="edit">✏️ Edit</a>
                    <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <a href="#" class="delete" onclick="this.closest('form').submit(); return false;">🗑️ Delete</a>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="mt-4 bg-white p-4 rounded shadow text-sm text-gray-700">
            <strong>Class Average: {{ round($average, 1) }}</strong> — {{ $students->count() }} student(s) total
        </div>
    @endif

    <script>
        const searchInput = document.getElementById('search-input');
        const filterSelect = document.getElementById('filter-select');
        const rows = document.querySelectorAll('.student-row');

        function filterStudents() {
            const search = searchInput.value.toLowerCase();
            const filter = filterSelect.value;

            rows.forEach(row => {
                const name = row.dataset.name.toLowerCase();
                const average = parseInt(row.dataset.average);

                const matchesSearch = name.includes(search);
                const matchesFilter =
                    filter === 'all' ||
                    (filter === 'passing' && average >= 50) ||
                    (filter === 'failing' && average < 50);

                row.style.display = matchesSearch && matchesFilter ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', filterStudents);
        filterSelect.addEventListener('change', filterStudents);
    </script>
@endsection