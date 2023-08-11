@include('layouts.Assets_P')
<main>
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Lista de actividades</h1>
            </div>
            <div class="col text-end">
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#addActivities">
                    <x-bi-plus-circle-fill /> Nuevo
                </button>
            </div>
        </div>
    </div>
    <hr style="background-color: #735AB6">
    <div class="container">
        <!-- Modal -->
        <form method="POST" action="{{ route('RegistrarActividad') }}">
            @csrf
            <div class="modal fade" id="addActivities" tabindex="-1" aria-labelledby="addActivitiesLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addActivitiesLabel">Nueva Actividad</h1>
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
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-success">
                {{ session('error') }}
            </div>
        @endif

        <div class="cont-card">
            @foreach ($activities as $activity)
                <div class="card card-tx mb-3">
                    <div class="card-header" style="background-color:{{ $activity['Color'] }}">
                        {{ $activity['Asignatura'] }}<br></div> <!-- Aqui necesito que card-color<id de asignatura> -->
                    <div class="card-body">
                        <h5 class="card-title">{{ $activity['Titulo'] }}</h5><!-- Titulo de tarea -->
                        <p class="card-text"> {{ $activity['Descripcion'] }} </p>
                        <a href="{{ route('ActivityShow', ['id' => $activity['id']]) }}" class="btn btn-primary">
                            Ver más</a>
                    </div>
                    </a>
                </div>
            @endforeach
        </div>
</main>
