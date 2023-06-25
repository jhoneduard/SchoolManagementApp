<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsignaturaController extends Controller
{
    public function geSubjects(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;

        $criterio = $request->criterio;

        if ($buscar == '') {
            $asignaturas =  DB::table('subjects')
                ->select('subjects.id', 'subjects.name', 'subjects.description','subjects.number_registered AS numberStudents','subjects.status AS state','subjects.initial_date AS initDate','end_date AS endDate', 'users.identification AS idTeacher', 'users.names AS nameTeacher', 'users.surnames AS surnamesTeacher','category_subject.name AS nameCategory','category_subject.id AS idCategory')
                ->join('users', 'users.id', '=', 'subjects.id_teacher')
                ->join('category_subject', 'category_subject.id', '=', 'subjects.id_category_subject')
                ->orderBy('subjects.id', 'desc')
                ->paginate(3);
        } else {
            $asignaturas =  DB::table('subjects')
            ->select('subjects.id', 'subjects.name', 'subjects.description','subjects.number_registered AS numberStudents','subjects.status AS state','subjects.initial_date AS initDate','end_date AS endDate', 'users.identification AS idTeacher', 'users.names AS nameTeacher', 'users.surnames AS surnamesTeacher','category_subject.name AS nameCategory','category_subject.id AS idCategory')
            ->join('users', 'users.id', '=', 'subjects.id_teacher')
            ->join('category_subject', 'category_subject.id', '=', 'subjects.id_category_subject')
            ->orderBy('subjects.id', 'desc')
            ->where($criterio, 'like', '%' . $buscar . '%')
            ->paginate(3);
        }
        return [
            'pagination' => [
                'total'        => $asignaturas->total(),
                'current_page' => $asignaturas->currentPage(),
                'per_page'     => $asignaturas->perPage(),
                'last_page'    => $asignaturas->lastPage(),
                'from'         => $asignaturas->firstItem(),
                'to'           => $asignaturas->lastItem(),
            ],
            'asignaturas' => $asignaturas
        ];
    }


    public function registerSubject(CreateSubjectRequest $request)
    {
        if (!$request->ajax()) return redirect('/');
        $subject = new Subject();
        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->number_registered = 0;
        $subject->status = 'Disponible';
        $subject->id_teacher = $request->id_teacher;
        $subject->id_category_subject = $request->id_category_subject;
        $subject->initial_date = $request->initial_date;
        $subject->end_date = $request->end_date;
        $subject->save();
    }

    public function updateSubject(UpdateSubjectRequest $request)
    {
        if (!$request->ajax()) return redirect('/');
        $subject = Subject::findOrFail($request->id);
        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->save();
    }

    public function destroy($id)
    {
        $subject = Subject::find($id);
        $subject->delete();
    }

    public function getTeachers(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $teachers = DB::table('users')
            ->select('id', DB::raw("CONCAT(names,' ',surnames) AS names"))
            ->where('id_category', '=', 3)
            ->get();
        return ['teachers' => $teachers];
    }

    public function getCategory(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categorias = DB::table('category_subject')
            ->select('id', 'name')
            ->get();
        return ['categorias' => $categorias];
    }

}
