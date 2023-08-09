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
        $person = $request->session()->get('persona');
        $activities = [];
        $activitys = DB::table('activity')
            ->where('id_person','=',$person->id)
            ->where('deadline','>',Carbon::today())
            ->whereIn('status', ['Pendiente', 'En proceso'])
            ->get();
        foreach($activitys as $activity){
            $signature = signature::where('id', $activity->id_signature)->first();
            $activities []= [
                'id' => $activity->id,
                'idAsignatura' => $activity->id_signature,
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
}
