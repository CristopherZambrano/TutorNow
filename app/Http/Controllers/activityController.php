<?php

namespace App\Http\Controllers;

use App\Models\activity;
use App\Models\detailsActivity;
use App\Models\lesson;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Madcoda\Youtube\Youtube;
use GuzzleHttp\Client;

class activityController extends Controller
{
    public function listActivityPending(Request $request)
    {
        $hidden = '';
        $person = $request->Session()->get('persona');

        $activities = [];
        if (($person->idTipoUser) === 1) {
            $hidden = 'hidden';
            $activitys = DB::table('studentList')
                ->where('id_person', $person->id)
                ->join('lessons', 'studentList.id_class', '=', 'lessons.id')
                ->join('activity', 'lessons.id', '=', 'activity.id_lessons')
                ->select(
                    'activity.id as activity_id',
                    'lessons.id as lesson_id',
                    'lessons.color',
                    'lessons.name',
                    'activity.title',
                    'activity.description',
                    'activity.deadline',
                    'activity.state',
                )
                ->where('activity.state', '=', 'Pendiente')
                ->get();
        } else {
            //Actividades registradas por el docente que se encuentren pendientes
            $activitys = DB::table('persons')
                ->join('lessons', 'persons.id', '=', 'lessons.id_persons')
                ->join('activity', 'lessons.id', '=', 'activity.id_lessons')
                ->select(
                    'activity.id as activity_id',
                    'lessons.id as lesson_id',
                    'lessons.color',
                    'lessons.name',
                    'activity.title',
                    'activity.description',
                    'activity.deadline',
                    'activity.state',
                )
                ->where('persons.id', '=', $person->id)
                ->where('activity.state', '=', 'Pendiente')
                ->orderBy('deadline', 'asc')
                ->get();
        }

        foreach ($activitys as $activity) {
            //$signature = signature::where('id', $activity->id_signature)->first();
            $activities[] = [
                'id' => $activity->activity_id,
                'idAsignatura' => $activity->lesson_id,
                'Color' => $activity->color,
                'Asignatura' => $activity->name,
                'Titulo' => $activity->title,
                'Descripcion' => $activity->description,
                'Fecha_Entrega' => $activity->deadline,
                //'Puntaje' => $activity->score,
                //'Estado' => $activity->status,
            ];
        }
        $signature = lesson::where('id_persons', '=', $person->id)->get();
        return view('Home', [
            'activities' => $activities,
            'signature' => $signature,
            'Hidden' => $hidden
        ]);
    }

    public function RegisterActivity(Request $request)
    {
        try {
            $activity = new activity();
            $person = $request->session()->get('persona');
            $activity->title = $request->input('titleImput');
            $activity->description = $request->input('descImput');
            $activity->deadline = $request->input('dateImput');
            $activity->id_lessons = $request->input('asigSelect');
            $activity->state = "Pendiente";

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
        $person = session()->get('persona');
        $activity = activity::findOrFail($id);
        $detalleActivity = detailsActivity::where('idActivity', $id)
            ->where('idPersons', $person->id);
        if (isset($detalleActivity)) {
            $detalleActivity->status = 'Pendiente';
        }
        $signature = lesson::findOrFail($activity->id_lessons);
        $youtube = new Youtube(['key' => env('YOUTUBE_API_KEY')]);
        $hidden = [];

        if (($person->idTipoUser) === 1) {
            $hidden[] = ['teacher' => 'hidden', 'student' => ''];
        } else {
            $hidden[] = ['teacher' => '', 'student' => 'hidden'];
        }
        if (isset($activity->title)) {
            $videos = $youtube->searchVideos($activity->title, 3);
            $query = $activity->title;
        } else {
            if (isset($activity->description)) {
                $videos = $youtube->searchVideos($activity->description, 3);
                $query = $activity->description;
            } else {
                $query = 'Uteq';
                $videos = $youtube->searchVideos('Uteq', 3);
            }
        }

       /*  $client = new Client();
        $response = $client->get('https://www.googleapis.com/customsearch/v1', [
            'query' => [
                'q' => $query,
                'key' => env('YOUTUBE_API_KEY'),
                'cx' => env('ID_BUSCADOR'),
                'fileType' => 'pdf',
            ],
        ]);
        $PDFs = json_decode($response->getBody(), true);


        $response = $client->get('https://www.googleapis.com/customsearch/v1', [
            'query' => [
                'q' => $query,
                'key' => env('YOUTUBE_API_KEY'),
                'cx' => env('ID_BUSCADOR'),
                'fileType' => 'pptx',
            ],
        ]); */
        //$Diapositivas = json_decode($response->getBody(), true);

        $signas = lesson::where('id_persons', $person->id)->get();

        return view('ActivityDetails', [
            'activity' => $activity,
            'detalleActivity' => $detalleActivity,
            'videos' => $videos,
            'signature' => $signature,
            'signas' => $signas,
           // 'PDFs' => $PDFs,
            //'Diapositivas' => $Diapositivas,
            'Hidden' => $hidden
        ]);
    }

    public function uploadFile(Request $request, $id)
    {
        $person = session()->get('persona');
        $request->validate([
            'archivo' => 'required|mimes:pdf,docx|max:5120',
        ]);
        $archivo = $request->file('archivo');
        $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
        $archivo->move(public_path('uploads'), $nombreArchivo);

        /*detailsActivity::create([
            'idActivity'=>$id,
            'idPersons'=> $person->id,
            'status'=> 'Enviado',
            'archivo' => $nombreArchivo,]);*/
        $detalle = new detailsActivity;
        $detalle->idActivity = $id;
        $detalle->idPersons = $person->id;
        $detalle->status = 'Enviado';
        $detalle->archivo = $nombreArchivo;
        $detalle->saveOrFail();

        return redirect()->back()->with('success', 'Archivo subido correctamente.');
    }

    public function updateActivity(Request $request, $id)
    {
        $activity = activity::find($id);
        $person = session()->get('persona');
        if ($activity) {
            $activity->id_lessons = $request->input('asigSelect');
            $activity->description = $request->input('descImput');
            $activity->deadline = $request->input('dateImput');
            $activity->title = $request->input('titleImput');
            $activity->state = $request->input('stateSelect');
            $activity->save();
            return redirect()->back()->with('success', 'Actividad actualizada correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar.');
        }
    }

    public function deleteActivity($id)
    {
        $act_details = detailsActivity::where('idActivity', $id);
        $activity = activity::find($id);

        if ($act_details) {
            $act_details->delete();
            if ($activity) {
                $activity->delete();
                return redirect()->route('Home')->with('success', 'Actividad eliminada correctamente.');
            } else {
                return redirect()->back()->with('error', 'Error al eliminar.');
            }
        } else {
            return redirect()->back()->with('error', 'Error al eliminar.');
        }
    }
}
