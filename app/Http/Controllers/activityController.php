<?php

namespace App\Http\Controllers;

use App\Models\activity;
use App\Models\person;
use App\Models\signature;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Madcoda\Youtube\Youtube;

class activityController extends Controller
{
    public function listActivityPending(Request $request)
    {
        $contador = 0;
        $person = $request->session()->get('persona');
        $activities = [];
        $activitys = DB::table('activity')
            ->where('id_person', '=', $person->id)
            ->where('deadline', '>', Carbon::today())
            ->whereIn('status', ['Pendiente', 'En proceso'])
            ->get();
        foreach ($activitys as $activity) {
            $signature = signature::where('id', $activity->id_signature)->first();
            $activities[] = [
                'id' => $activity->id,
                'idAsignatura' => $activity->id_signature,
                'Color' => $signature->color,
                'Asignatura' => $signature->name,
                'Titulo' => $activity->title,
                'Descripcion' => $activity->description,
                'Fecha_Entrega' => $activity->deadline,
                'Puntaje' => $activity->score,
                'Estado' => $activity->status,
            ];
        }
        $signature = Signature::where('id_person', $person->id)->get();
        return view('Home', [
            'activities' => $activities,
            'signature' => $signature,
        ]);
    }

    public function RegisterActivity(Request $request)
    {
        try {
            $activity = new activity();
            $person = $request->session()->get('persona');

            $activity->id_signature = $request->input('asigSelect');
            $activity->id_person = $person->id;
            $activity->description = $request->input('descImput');
            $activity->deadline = $request->input('dateImput');
            $activity->title = $request->input('titleImput');
            $activity->status = 'Pendiente';

            if ($activity->deadline < Carbon::today()) {
                return redirect()->route('Home')->with('error', 'Fecha no permitida');
            } else {
                $activity->save();
                return redirect()->route('Home')->with('success', 'Nueva actividad registrada');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function Show($id)
    {
        $activity = activity::findOrFail($id);
        $signature = signature::findOrFail($activity->id_signature);
        $youtube = new Youtube(['key' => env('YOUTUBE_API_KEY')]);

        if (isset($activity->title)) {
            $videos = $youtube->searchVideos($activity->title, 3);
        } else {
            if (isset($activity->description)) {
                $videos = $youtube->searchVideos($activity->description, 3);
            } else {
                $videos = $youtube->searchVideos('Uteq', 3);
            }
        }
        $signas = Signature::where('id_person', $activity->id_person)->get();

        return view('ActivityDetails', [
            'activity' => $activity,
            'videos' => $videos,
            'signature' => $signature,
            'signas' => $signas,
        ]);
    }

    public function updateActivity(Request $request, $id)
    {
        $activity = activity::find($id);
        if ($activity) {
            $activity->id_signature = $request->input('asigSelect');
            $activity->description = $request->input('descImput');
            $activity->deadline = $request->input('dateImput');
            $activity->score = $request->input('scoreInput');
            $activity->status = $request->input('stateEdit');
            $activity->title = $request->input('titleImput');
            $activity->save();
            return redirect()->back()->with('success', 'Actividad actualizada correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar.');
        }
    }

    public function deleteActivity($id)
    {
        $activity = activity::find($id);

        if ($activity) {
            $activity->delete();
            return redirect()->route('Home')->with('success', 'Actividad eliminada correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al eliminar.');
        }
    }
}
