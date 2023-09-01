<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\person;
use App\Models\signature;

class AsigController extends Controller
{
    public function RegisterAsig(Request $request)
    {
        try {

            $person = $request->session()->get('persona');
            $signature = new signature();
            // $person = $request->session()->get('persona');

            $signature->name = $request->input('inputNombre');
            $signature->teacher = $request->input('inputProfesor');
            $signature->color = $request->input('inputColor');
            $signature->id_person = $person->id;

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
        $asignatura = DB::table('signature')
            ->where('id_person', $person->id)
            ->get();
        foreach($asignatura as $signature){
            $signatures []= [
                'num'=> $count,
                'idAsig'=> $signature->id,
                'materia' => $signature->name,
                'profesor' => $signature->teacher,
                'Color' =>$signature->color,
            ];
            $count++;
        }
        return view('Asig', ['signatures' => $signatures,'hidden' => $hidden]);
    }

    public function deleteSubject($id){
        $signature = signature::find($id);

        if ($signature) {
            $signature->delete();
            return redirect()->back()->with('success', 'Actividad eliminada correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al eliminar.');
        }
    }
}
