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
                ->select('id', 'name', 'description')
                ->orderBy('id', 'desc')
                ->paginate(3);
        } else {
            $asignaturas =  DB::table('subjects')
                ->select('id', 'name', 'description')
                ->orderBy('id', 'desc')
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
}
