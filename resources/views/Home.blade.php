@include('layouts.Assets_P')
<main>
        <div class="container" <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addActivities">
                <x-bi-plus-circle-fill /> Nuevo
            </button>
            <!-- Modal -->
            <form method="POST" action="{{route('RegistrarActividad')}}">
                @csrf
            <div class="modal fade" id="addActivities" tabindex="-1" aria-labelledby="addActivitiesLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addActivitiesLabel">Nueva Actividad</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
<!--                             <div class="row">
                                <div class="col">
                                    <label for="stateSelect" class="form-label">Estado</label>
                                    <select class="form-select" name="stateSelect" id="stateSelect" require>
                                        <option disabled selected>Seleccione</option>
                                        <option value="1">Pendiente</option>
                                        <option value="2">En proceso</option>
                                        <option value="3">Completado</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="califImput" class="form-label">Calificación</label>
                                    <input type="number" name="califImput" class="form-control" id="califImput">
                                </div>

                            </div> -->
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
                                    <input type="date" name="dateImput" class="form-control" id="dateImput" require min="{{Carbon\Carbon::today()->format('D-M-Y')}}">
                                </div>
                                <div class="col">
                                    <label for="asigSelect" class="form-label">Asignatura</label>
                                    <select class="form-select" aria-label="Default select example" name="asigSelect" require>
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success')}}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-success">
            {{ session('error')}}
        </div>
        @endif
            <h1>Bienvenido a TutorNow</h1>
            <div class="cont-card">
                @foreach ($activities as $activity)
                <div class="card card-tx mb-3" style="max-width: 18rem;">
                    <a href="{{ route('ActivityShow', ['id' => $activity['id']]) }}" class="card-link">
                    <div class="card-header card-color" data-color="color-1">{{$activity['Asignatura']}}<br></div> <!-- Aqui necesito que card-color<id de asignatura> -->
                    <div class="card-body">
                        <h5 class="card-title">Titulo de tarea</h5><!-- Titulo de tarea -->
                        <p class="card-text"> {{$activity['Descripcion']}} </p>
                    </div>
                    </a>
                </div>
                @endforeach
                <div class="card card-tx mb-3" style="max-width: 18rem;">
                    <div class="card-header card-color" data-color="color-2">Asignatura</div> <!-- Aqui necesito que card-color<id de asignatura> -->
                    <div class="card-body">
                        <h5 class="card-title">Titulo de tarea</h5>
                        <p class="card-text"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.  </p>
                    </div>
                </div>
                <div class="card card-tx mb-3" style="max-width: 18rem;">
                    <div class="card-header card-color"data-color="color-1">Asignatura</div> <!-- Aqui necesito que card-color<id de asignatura> -->
                    <div class="card-body">
                        <h5 class="card-title">Titulo de tarea</h5>
                        <p class="card-text"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.  </p>
                    </div>
                </div>
            </div>

            <ul>
                @foreach ($activities as $activity)
                <li>
                    id: {{$activity['id']}} <br>
                    Asignatura: {{$activity['Asignatura']}} <br>
                    Descripcion: {{$activity['Descripcion']}} <br>
                    Fecha de entrega: {{$activity['Fecha_Entrega']}} <br>
                    Puntaje: {{$activity['Puntaje']}} <br>
                    Estado: {{$activity['Estado']}} <br>
                    Color: {{$activity['Color']}} <br>
                </li>
                @endforeach
            </ul>
        </div>
</main>