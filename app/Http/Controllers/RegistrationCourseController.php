<?php

namespace App\Http\Controllers;

use App\Models\RegistrationSubject;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegistrationCourseController extends Controller
{
    public function getCourses(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        // Obtenemos los cursos actualmente registrados por el usuario
        $cursosRegistradosByUser = DB::table('registration_subjects')
            ->select('id_subject')
            ->where('id_student', '=', auth()->user()->id)
            ->get()->pluck('id_subject');

        if ($buscar == '') {
            $courses_available = DB::table('subjects')
                ->select(
                    'subjects.id',
                    'subjects.name AS nameSubject',
                    DB::raw("CONCAT(users.names,' ',users.surnames) AS nameTeacher"),
                    'category_subject.name AS nameCategory'
                )
                ->join('category_subject', 'category_subject.id', '=', 'subjects.id_category_subject')
                ->join('users', 'users.id', '=', 'subjects.id_teacher')
                ->whereNotIn('subjects.id', $cursosRegistradosByUser)
                ->orderBy('subjects.id', 'desc')
                ->paginate(3);
        } else {
            $courses_available = DB::table('subjects')
                ->select(
                    'subjects.id',
                    'subjects.name AS nameSubject',
                    DB::raw("CONCAT(users.names,' ',users.surnames) AS nameTeacher"),
                    'category_subject.name AS nameCategory'
                )
                ->join('category_subject', 'category_subject.id', '=', 'subjects.id_category_subject')
                ->join('users', 'users.id', '=', 'subjects.id_teacher')
                ->orderBy('subjects.id', 'desc')
                ->where($criterio, 'like', '%' . $buscar . '%')
                ->whereNotIn('subjects.id', $cursosRegistradosByUser)
                ->paginate(3);
        }
        return [
            'pagination' => [
                'total'        => $courses_available->total(),
                'current_page' => $courses_available->currentPage(),
                'per_page'     => $courses_available->perPage(),
                'last_page'    => $courses_available->lastPage(),
                'from'         => $courses_available->firstItem(),
                'to'           => $courses_available->lastItem(),
            ],
            'courses_available' => $courses_available
        ];
    }

    public function courseRecommendations(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        // Obtenemos los cursos actualmente registrados por el usuario
        $cursosRegistradosByUser = DB::table('registration_subjects')
            ->select('id_subject')
            ->where('id_student', '=', auth()->user()->id)
            ->get()->pluck('id_subject');

        if ($buscar == '') {
            $courses_recommendations = DB::table('subjects')
                ->select(
                    'subjects.id',
                    'subjects.name AS nameSubject',
                    DB::raw("CONCAT(users.names,' ',users.surnames) AS nameTeacher"),
                    'category_subject.name AS nameCategory',
                    'subjects.number_registered AS quantityStudents'
                )
                ->join('category_subject', 'category_subject.id', '=', 'subjects.id_category_subject')
                ->join('users', 'users.id', '=', 'subjects.id_teacher')
                ->whereNotIn('subjects.id', $cursosRegistradosByUser)
                ->orderBy('subjects.number_registered', 'desc')
                ->paginate(3);
        } else {
            $courses_recommendations = DB::table('subjects')
                ->select(
                    'subjects.id',
                    'subjects.name AS nameSubject',
                    DB::raw("CONCAT(users.names,' ',users.surnames) AS nameTeacher"),
                    'category_subject.name AS nameCategory',
                    'subjects.number_registered AS quantityStudents'
                )
                ->join('category_subject', 'category_subject.id', '=', 'subjects.id_category_subject')
                ->join('users', 'users.id', '=', 'subjects.id_teacher')
                ->orderBy('subjects.number_registered', 'desc')
                ->where($criterio, 'like', '%' . $buscar . '%')
                ->whereNotIn('subjects.id', $cursosRegistradosByUser)
                ->paginate(3);
        }
        return [
            'pagination' => [
                'total'        => $courses_recommendations->total(),
                'current_page' => $courses_recommendations->currentPage(),
                'per_page'     => $courses_recommendations->perPage(),
                'last_page'    => $courses_recommendations->lastPage(),
                'from'         => $courses_recommendations->firstItem(),
                'to'           => $courses_recommendations->lastItem(),
            ],
            'courses_recommendations' => $courses_recommendations
        ];
    }

    public function registrationCourse(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        // Se registrara el curso seleccionado en la tabla de registration_subjects
        $subject = new RegistrationSubject();
        $subject->id_subject = $request->id_subject;
        $subject->id_student = auth()->user()->id;
        $mytime = Carbon::now();
        $subject->date_registration = $mytime;
        $subject->status = 'EN CURSO';
        $subject->qualification_end = 0;
        $subject->save();

        // Se actualiza la cantidad de estudiantes registrados en el curso de estudiantes
        $subjectUpdate = Subject::findOrFail($request->id_subject);
        $subjectUpdate->number_registered =  $subjectUpdate->number_registered + 1;
        $subjectUpdate->save();
    }
}
