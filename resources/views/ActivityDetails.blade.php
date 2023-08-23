@include('layouts.Assets_P')
<main>
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>{{ $activity->title }}</h1>
            </div>

            <div class="col text-end">
                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                    data-bs-target="#editActivity">
                    <x-bi-pencil-square /> Editar
                </button>
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" 
                data-bs-target="#deleteModal">
                    <x-bi-trash /> Eliminar
                   {{--  {{ route('ActivityShow', ['id' => $activity['id']]) }} --}}
                </button>
            </div>
        </div>
    </div>
    <hr style="background-color: #735AB6">
    <br />

    <div class="container">
        <div class="card card-edit">
            <div class="card-body">
                <dt class="col-sm-3">Asignatura</dt>
                <dd class="col-sm-9">{{ $signature->name }}</dd>

                <dt class="col-sm-3">Descripción</dt>
                <dd class="col-sm-9">{{ $activity->description }}</dd>
                <div class="row g-3">
                    <div class="col">
                        <dt class="col-sm-3">Entrega</dt>
                        <dd class="col-sm-9">
                            {{ $activity->deadline }}
                        </dd>
                    </div>

                    <div class="col">
                        <dt class="col-sm-3">Estado</dt>
                        <dd class="col-sm-9">{{ $activity->status }}</dd>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <br />
    <hr style="background-color: #735AB6">

    <div class="container">
        <!-- Modal -->
        <form method="POST" action="{{ route('ActActividad', ['id' => $activity['id']]) }}">
            @csrf
            <div class="modal fade" id="editActivity" tabindex="-1" aria-labelledby="editActivityLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editActivityLabel">Nueva Actividad</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="stateEdit" class="form-label">Estado</label>
                                    <select class="form-select" aria-label="Default select example" name="stateEdit"
                                    id="stateEdit" require>
                                        <option selected value="{{ $activity->status }}">{{ $activity->status }}</option>
                                            <option value="Pendiente">Pendiente</option>
                                            <option value="En proceso">En proceso</option>
                                            <option value="Completado">Completado</option>
                                    </select>
                                </div>
                                <div class="col" id="scoreContainer" style="display: none">
                                    <label for="scoreInput" class="form-label">Calificación</label>
                                    <input type="number" value="{{ $activity->score }}" name="scoreInput" class="form-control" id="scoreInput">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="titleImput" class="form-label">Titulo</label>
                                <input name="titleImput" value="{{ $activity->title }}" class="form-control" id="titleImput" require>
                            </div>
                            <div class="mb-3">
                                <label for="descImput" class="form-label">Descripción</label>
                                <textarea name="descImput"  class="form-control" id="descImput" rows="3">{{ $activity->description }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="dateImput" class="form-label">Entrega</label>
                                    <input type="date" value="{{ $activity->deadline }}" name="dateImput" class="form-control" id="dateImput" require
                                        min="{{ Carbon\Carbon::today()->format('D-M-Y') }}">
                                </div>
                                <div class="col">
                                    <label for="asigSelect" class="form-label">Asignatura</label>
                                    <select class="form-select" aria-label="Default select example" name="asigSelect"
                                        require>
                                        <option selected value="{{ $signature->id }}">{{ $signature->name }}</option>
                                        @foreach($signas as $signa)
                                            <option value="{{$signa['id']}}">{{$signa['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form method="GET" action="{{ route('delActividad', ['id' => $activity['id']]) }}">
            <div class="modal" tabindex="-1" id="deleteModal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Eliminar Actividad</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Esta seguro de que desea eliminar la actividad:</p>
                      <p style="font-weight: bold;">{{ $activity->title }} </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-danger">Si</button>
                    </div>
                  </div>
                </div>
              </div>
        </form>
    </div>
    <div class="container" style="text-align: center;">
        <h1>Videos relacionados a la actividad</h1>
    </div>
    <br />
    <div class="ct">
        <ul class="video-list">
           {{-- esto esta comentado--}}
             @foreach ($videos as $video)
                <li>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $video->id->videoId }}"
                        frameborder="0" allowfullscreen></iframe>
                </li>
            @endforeach 
        </ul>
    </div>
    <div class="container" style="text-align: center;">
        <h1>Archivos PDFs relacionados a la actividad</h1>
    </div>
    <div>
        <ul>
            @foreach($PDFs['items'] as $PDF)
                <li>
                    <a href="{{$PDF['link']}}" target="_blank">
                        {{$PDF['title']}}
                    </a>
                    <p>{{$PDF['snippet']}}</p>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="container" style="text-align: center;">
        <h1>Diapositivas relacionadas a la actividad</h1>
    </div>
    <div>
        <ul>
            @foreach($Diapositivas['items'] as $Diapositiva)
                <li>
                    <a href="{{$Diapositiva['link']}}" target="_blank">
                        {{$Diapositiva['title']}}
                    </a>
                    <p>{{$Diapositiva['snippet']}}</p>
                </li>
            @endforeach
        </ul>
    </div>

    <script src="{{ asset('js/colors.js') }}"></script>
</main>
