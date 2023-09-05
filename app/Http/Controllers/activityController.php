<?php

namespace App\Http\Controllers;

use App\Models\activity;
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
                    'activity.score',
                    'activity.status'
                )
                ->get();
        } else {
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
                    'activity.score',
                    'activity.status'
                )
                ->where('persons.id', '=', $person->id)
                //->where('deadline', '>', Carbon::today())
                ->whereIn('status', ['Pendiente', 'En proceso'])
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
                'Puntaje' => $activity->score,
                'Estado' => $activity->status,
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
        $signature = lesson::findOrFail($activity->id_lessons);
        $youtube = new Youtube(['key' => env('YOUTUBE_API_KEY')]);
        $hidden = [];
        $person = session()->get('persona');
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

        $client = new Client();
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
        ]);
        $Diapositivas = json_decode($response->getBody(), true);

        $signas = lesson::where('id_persons', $person->id)->get();

        return view('ActivityDetails', [
            'activity' => $activity,
            'videos' => $videos,
            'signature' => $signature,
            'signas' => $signas,
            'PDFs' => $PDFs,
            'Diapositivas' => $Diapositivas,
            'Hidden' => $hidden
        ]);
    }

    public function updateActivity(Request $request, $id)
    {
        $activity = activity::find($id);
        $person = session()->get('persona');
        if ($activity) {
/*             if (($person->idTipoUser) === 1) {
                $Video = $request->has('checkVideo') ? 1 : 0;
                $checkPdf = $request->has('checkPdf') ? 1 : 0;
                $checkPpt = $request->has('checkPpt') ? 1 : 0;
                $activity->status = $request->input('stateEditS');
                $activity->video = $Video;
                $activity->pdf = $checkPdf;
                $activity->ppt = $checkPpt;
            } else { */
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
