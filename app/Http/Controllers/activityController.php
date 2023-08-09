<?php

namespace App\Http\Controllers;

use App\Models\activity;
use App\Models\person;
use App\Models\signature;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class activityController extends Controller
{
    public function listActivityPending(Request $request){
        $contador = 0;
        $person = $request->session()->get('persona');
        $activities = [];
        $activitys = DB::table('activity')
            ->where('id_person','=',$person->id)
            ->where('deadline','>',Carbon::today())
            ->whereIn('status', ['Pendiente', 'En proceso'])
            ->get();
        foreach($activitys as $activity){
            $contador += 1;
            $signature = signature::where('id', $activity->id_signature)->first();
            $activities []= [
                'id' => $activity->id,
                'idAsignatura' => $activity->id_signature,
                'Color' =>$contador,
                'Asignatura' => $signature->name,
                'Titulo' => $activity->title,
                'Descripcion' => $activity->description,
                'Fecha_Entrega' => $activity->deadline,
                'Puntaje' => $activity->score,
                'Estado' => $activity->status,
            ];
        }
        return view('Home', compact('activities'));
    }

    public function RegisterActivity(Request $request){
        try{
            $activity = new activity();
            $person = $request->session()->get('persona');
    
            $activity->id_signature = $request->input('asigSelect');
            $activity->id_person = $person->id;
            $activity->description = $request->input('descImput');
            $activity->deadline = $request->input('dateImput');
            $activity->title = $request->input('titleImput');
            $activity->status = 'Pendiente';

            if($activity->deadline < Carbon::today()){
                return redirect()->route('Home')->with('error', 'Fecha no permitida');
            }
            else{
                $activity->save();
                return redirect()->route('Home')->with('success', 'Nueva actividad registrada');
            }
        } catch(\Exception $e){
            dd($e->getMessage());
        }
    }
}
