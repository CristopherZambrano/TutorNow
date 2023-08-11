@include('layouts.Assets_P')
<main>
    <div class="container">
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#asigModal">
            <x-bi-plus-circle-fill /> Nuevo
        </button>
        <form method="POST" action="{{route('RegistrarAsig')}}">
            @csrf
            <!-- Modal -->
            <div class="modal fade" id="asigModal" tabindex="-1" aria-labelledby="asigModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="asigModalLabel">Nueva Asignatura</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label for="inputNombre" class="col-sm-2 col-form-label">Materia</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputNombre" name="inputNombre" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputProfesor" class="col-sm-2 col-form-label">Profesor</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputProfesor" name="inputProfesor" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputColor" class="col-sm-2 col-form-label">Color</label>
                                <div class="col-sm-10">
                                    <input type="color" class="form-control form-control-color" id="inputColor"
                                        value="#563d7c" title="Choose your color" name="inputColor">
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
    <div class="container">
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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Materia</th>
                    <th scope="col">Profesor</th>
                    <th scope="col">Color</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($signatures as $signature)
                <tr>
                    <th scope="row">{{$signature['num']}}</th>
                    <td>{{$signature['materia']}}</td>
                    <td>{{$signature['profesor']}}</td>
                    <td><div class="color-square" style="background-color: {{$signature['Color']}};"></div></td>
                    <td><a class="edit-button" href="#">Editar</a>
                        <a class="delete-button" href="#">Eliminar</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <script src="{{ asset('js/colors.js') }}"></script>
</main>
