<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    # method index - get all resources
    public function index()
    {
        # menggunakan model Student untuk select data
        $students = Student::all();

        $data = [
            'message' => 'Get all students',
            'data' => $students,
        ];

        # menggunakan response json laravel
        # otomatis set header content type json
        # otomatis mengubah data array ke JSON
        # mengatur status code
        return response()->json($data, 200);
    }

    # menambahkan resource student
    # membuat method store
    public function store(Request $request)
    {
        # menangkap data request
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
        ];

        # menggunakan Student untuk insert data
        $student = Student::create($input);

        $data = [
            'message' => 'Student is created successfully',
            'data' => $student,
        ];

        # mengembalikan data (json) status code 201
        return response()->json($data, 201);
    }

    #mendapatkan detail resource student
    #membuat method show
    public function show($id)
    {
        #cari data student
        $student = Student::find($id);

        if ($student) {
            $data = [
                'massage' => 'Get detail student',
                'data' => $student,
            ];

            #mengembalikan data json status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'massage' => 'student not fount'
            ];

            #mengembalikan data json status code 404
            return response()->json($data, 404);
        }
    }

    #mengupdate resource student
    #membuat method update
    public function update(Request $request, $id)
    {
        #cari data student yang ingin di update
        $student = Student::find($id);

        if ($student) {
            #mendapatkan data request
            $input = [
                'nama' => $request->nama ?? $student->nama,
                'nim' => $request->nim ?? $student->nim,
                'email' => $request->email ?? $student->email,
                'jurusan' => $request->jurusan ?? $student->jurusan,
            ];

            #mengupdate data
            $student->update($input);

            $data = [
                'message' => 'resource student update',
                'data' => $student,
            ];

            #mengirim respon json dengan status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'massage' => 'student not fount'
            ];

            #mengembalikan data json status code 404
            return response()->json($data, 404);
        }
    }

    public function destouy($id)
    {
        #cari data student yg ingin dihapus
        $student = Student::find($id);

        if ($student) {
            #hapus data student
            $student->delete();

            $data = [
                'message' => 'student is delete'
            ];

            #mengembalikan data json dengan status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'massage' => 'student not fount'
            ];

            #mengembalikan data json status code 404
            return response()->json($data, 404);
        }
    }
}
