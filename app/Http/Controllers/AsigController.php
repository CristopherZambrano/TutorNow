<?php

namespace App\Http\Controllers;

use App\Models\lesson;
use App\Models\studentList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AsigController extends Controller
{
    
    public function RegisterAsig(Request $request)
    {
        try {
            $person = $request->session()->get('persona');
            $signature = new lesson();
            $signature->name = $request->input('inputNombre');
            $signature->code = $request->input('inputCodigo') . Str::random(6);
            $signature->color = $request->input('inputColor');
            $signature->id_persons = $person->id;

            $signature->save();
            return redirect()->route('subject')->with('success', 'Nueva Clase registrada');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function listAsig(Request $request)
    {
        $hidden = [];

        $person = $request->session()->get('persona');
        $count = 1;
        $signatures = [];

        if (($person->idTipoUser) === 1) {
            $hidden[] = ['teacher' => 'hidden', 'student' => ''];

            $classes = DB::table('studentList')
                ->select('studentList.id', 'studentList.id_person', 'studentList.id_class', 'studentList.created_at', 'studentList.updated_at', 'lessons.name', 'lessons.code', 'lessons.color')
                ->join('lessons', 'studentList.id_class', '=', 'lessons.id')
                ->where('studentList.id_person', '=', $person->id)
                ->get();

        } else {
            $hidden[] = [
                'teacher' => '',
                'student' => 'hidden',
            ];
            $classes = DB::table('lessons')
                ->where('id_persons', $person->id)
                ->get();
        }
        foreach ($classes as $signature) {
            $signatures[] = [
                'num' => $count,
                'idAsig' => $signature->id,
                'nombre' => $signature->name,
                'codigo' => $signature->code,
                'Color' => $signature->color,
            ];
            $count++;
        }
        return view('Asig', ['signatures' => $signatures, 'hidden' => $hidden]);
    }

    public function deleteSubject($id)
    {
        $signature = lesson::find($id);

        if ($signature) {
            $signature->delete();
            return redirect()->back()->with('success', 'Actividad eliminada correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al eliminar.');
        }
    }

    public function RegisterClass(Request $request)
    {
        try {
            $person = $request->session()->get('persona');

            $codeBuscado = $request->input('imputCode');
            $idEncontrado = Lesson::where('code', $codeBuscado)->value('id');

            $studentList = new studentList();
            $studentList->id_person = $person->id;
            $studentList->id_class = $idEncontrado;

            if ($idEncontrado !== null) {
                $studentList->save();
            } else {
                return redirect()->back()->with('error', 'No se encontro la clase.');
            }

            return redirect()->route('subject')->with('success', 'Nueva Clase registrada');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
