<?php

namespace App\Http\Controllers;

use App\Models\lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\person;
use App\Models\signature;
use Illuminate\Support\Str;

class AsigController extends Controller
{
    public function RegisterAsig(Request $request)
    {
        try {
            $person = $request->session()->get('persona');
            $signature = new lesson();
            $signature->name = $request->input('inputNombre');
            $signature->code = Str::random(6);
            $signature->color = $request->input('inputColor');
            $signature->id_persons = $person->id;

            $signature->save();
            return redirect()->route('subject')->with('success', 'Nueva asignatura registrada');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function listAsig(Request $request){
        $hidden = [];

        $person = $request->session()->get('persona');
        if(($person->idTypeUser)===2){
            $hidden[]=[
            'teacher' => 'hidden',
            'student' => '',
            ];
        }else{
            $hidden[]=[ 'teacher' => '', 'student' => 'hidden'];
        }
        $count = 1;
        $signatures = [];
        $asignatura = DB::table('lessons')
            ->where('id_persons', $person->id)
            ->get();
        foreach($asignatura as $signature){
            $signatures []= [
                'num'=> $count,
                'idAsig'=> $signature->id,
                'materia' => $signature->name,
                'profesor' => $signature->code,
                'Color' =>$signature->color,
            ];
            $count++;
        }
        return view('Asig', ['signatures' => $signatures,'hidden' => $hidden]);
    }

    public function deleteSubject($id){
        $signature = lesson::find($id);

        if ($signature) {
            $signature->delete();
            return redirect()->back()->with('success', 'Actividad eliminada correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al eliminar.');
        }
    }
}
