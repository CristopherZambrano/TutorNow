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
            $signature = new signature();
            // $person = $request->session()->get('persona');

            $signature->name = $request->input('inputNombre');
            $signature->teacher = $request->input('inputProfesor');
            $signature->color = $request->input('inputColor');

            $signature->save();
            return redirect()->route('subject')->with('success', 'Nueva asignatura registrada');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function listAsig(Request $request){
        $person = $request->session()->get('persona');
        $count = 1;
        $signatures = [];
        $asignatura = DB::table('signature as s')
            ->select('s.id', 's.name', 's.teacher', 's.color')
            ->distinct()
            ->join('activity as a', 'a.id_signature', '=', 's.id')
            ->where('a.id_person', $person->id)
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
        return view('Asig', compact('signatures'));
    }
}