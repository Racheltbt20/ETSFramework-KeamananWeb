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
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                ->orWhere('npm', 'like', "%{$search}%");
            });
        }

        $students = $query->latest()->get();

        return view('index', compact('students'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'npm' => 'required|numeric|digits:11|unique:students,npm',
            'nama' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:100',
            'jurusan' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:50',
            'angkatan' => 'required|digits:4'
        ]);

        Student::create($request->only(['npm', 'nama', 'jurusan', 'angkatan']));

        return redirect()->route('students.index')->with('success', 'Data Mahasiswa Berhasil Ditambahkan!');
    }

    public function show(string $id)
    {
 
    }

    public function edit(Student $student)
    {
        return view('edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'npm' => 'required|numeric|digits:11|unique:students,npm,' . $student->id,
            'nama' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:100',
            'jurusan' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:50',
            'angkatan' => 'required|digits:4',
        ]);

        $student->update($request->only(['npm', 'nama', 'jurusan', 'angkatan']));

        return redirect()->route('students.index', ['search' => $request->search])
            ->with('success', 'Data Mahasiswa berhasil Diperbarui!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->back()->with('success', 'Data Mahasiswa Berhasil Dihapus!');
    }
}