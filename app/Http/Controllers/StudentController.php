<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filter === 'passing') {
            $query->where('average', '>=', 50);
        } elseif ($request->filter === 'failing') {
            $query->where('average', '<', 50);
        }

        $students = $query->orderBy('average', 'desc')->get();
        $average = $students->avg('average');

        return view('students.index', compact('students', 'average'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'math'    => 'required|integer|min:0|max:100',
            'english' => 'required|integer|min:0|max:100',
            'science' => 'required|integer|min:0|max:100',
            'history' => 'required|integer|min:0|max:100',
        ]);

        $average = round(($request->math + $request->english + $request->science + $request->history) / 4);

        Student::create([
            'name'    => $request->name,
            'math'    => $request->math,
            'english' => $request->english,
            'science' => $request->science,
            'history' => $request->history,
            'average' => $average,
        ]);

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'math'    => 'required|integer|min:0|max:100',
            'english' => 'required|integer|min:0|max:100',
            'science' => 'required|integer|min:0|max:100',
            'history' => 'required|integer|min:0|max:100',
        ]);

        $average = round(($request->math + $request->english + $request->science + $request->history) / 4);

        $student->update([
            'name'    => $request->name,
            'math'    => $request->math,
            'english' => $request->english,
            'science' => $request->science,
            'history' => $request->history,
            'average' => $average,
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}