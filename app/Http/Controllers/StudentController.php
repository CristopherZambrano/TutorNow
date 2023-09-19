<?php

namespace App\Http\Controllers;

use App\Models\activity;
use App\Models\detailsActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\studentList;
use App\Models\lesson;
use App\Models\person;

class StudentController extends Controller
{
    public function listStudent($id)
    {
        $count = 1;
        $classId = $id;
        $estudiantes = [];
        $clase = lesson::findOrFail($id);
        $persons = DB::table('persons as p')
            ->select('p.id', 'p.name', 'p.lastName')
            ->distinct()
            ->join('studentList as s', 'p.id', '=', 's.id_person')
            ->where('s.id_class', $classId)
            ->get();

            foreach ($persons as $person) {
                $estudiantes[] = [
                    'num' => $count,
                    'idStudent' => $person->id,
                    'nombre' => $person->name,
                    'apellido' => $person->lastName,
                ];
                $count++;
            }
            return view('StudentsClass', ['student' => $estudiantes, 'clase' => $clase]);
    }

    public function tareaStudent($id)
    {
        $count = 1;
        $classId = $id;
        $estudiantes = [];
        $Actividad = activity::findOrFail($id);
        $persons = DB::table('persons as p')
            ->select('s.id', 'p.name', 'p.lastName', 's.archivo', 's.score')
            ->distinct()
            ->join('activity_details as s', 'p.id', '=', 's.idPersons')
            ->where('s.idActivity', $classId)
            ->where('p.idTipoUser', 1)
            ->get();

        if ($persons->isEmpty()) {
            echo "No se encuentra actividad.";
        } else {
            foreach ($persons as $person) {
                $estudiantes[] = [
                    'num' => $count,
                    'id' => $person->id,
                    'nombre' => $person->name,
                    'apellido' => $person->lastName,
                    'archivo' => $person->archivo,
                    'score' => $person->score,
                ];
                $count++;
            }
            return view('Calificar', ['student' => $estudiantes, 'actividad' => $Actividad]);
        }
    }
    public function updateScore(Request $request, $id)
    {
        $newScore = $request->input('score');
        $student = detailsActivity::find($id);
        $student->score = $newScore;
        $student->save();
        return response()->json(['message' => 'Calificación actualizada con éxito']);
    }
}
