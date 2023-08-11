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
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#">
                    <x-bi-trash /> Eliminar
                </button>
            </div>
        </div>
    </div>
    <hr style="background-color: #735AB6">
    <br />

        {{-- {{ $signature }}
        {{ $activity }} --}}

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
        <form method="POST">
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
                            <div class="mb-3">
                                <label for="titleloImput" class="form-label">Titulo</label>
                                <input name="titleImput" class="form-control" id="titleImput" require>
                            </div>
                            <div class="mb-3">
                                <label for="descImput" class="form-label">Descripción</label>
                                <textarea name="descImput" class="form-control" id="descImput" rows="3"></textarea>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="dateImput" class="form-label">Entrega</label>
                                    <input type="date" name="dateImput" class="form-control" id="dateImput" require
                                        min="{{ Carbon\Carbon::today()->format('D-M-Y') }}">
                                </div>
                                <div class="col">
                                    <label for="asigSelect" class="form-label">Asignatura</label>
                                    <select class="form-select" aria-label="Default select example" name="asigSelect"
                                        require>
                                        <option selected>Open this select menu</option>
                                        <option value="1">...</option>
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
    </div>


    <div class="container" style="text-align: center;">
        <h1>Videos relacionados a la actividad</h1>
    </div>
    <br />
    <div class="ct">
        <ul>
            @foreach ($videos as $video)
                <li>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $video->id->videoId }}"
                        frameborder="0" allowfullscreen></iframe>
                </li>
            @endforeach
        </ul>
    </div>
</main>
