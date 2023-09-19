@include('layouts.Assets_P')
<main>
    <div class="container">
        @foreach ($hidden as $hid)
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#asigModal"
                {{ $hid['teacher'] }}>
                <x-bi-plus-circle-fill /> Nuevo
            </button>
            <div class="col text-end">
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#ingresoClase" {{ $hid['student'] }}>
                    <x-bi-plus-circle-fill /> Nuevo
                </button>
            </div>
        @endforeach
        <form method="POST" action="{{ route('RegistrarAsig') }}">
            @csrf
            <!-- Modal -->
            <div class="modal fade" id="asigModal" tabindex="-1" aria-labelledby="asigModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="asigModalLabel">Nueva Clase</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label for="inputNombre" class="col-sm-2 col-form-label">Nombre: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputNombre" name="inputNombre"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputCodigo" class="col-sm-2 col-form-label">Código: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputCodigo" name="inputCodigo"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputColor" class="col-sm-2 col-form-label">Color: </label>
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
        <form method="POST" action="{{ route('IngresarClase') }}">
            @csrf
            <div class="modal fade" id="ingresoClase" tabindex="-1" aria-labelledby="ingresoClaseLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ingresoClaseLabel">Nueva Clase</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="imputCode" class="form-label">Codigo</label>
                                <input name="imputCode" class="form-control" id="imputCode" require>
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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col" {{ $hid['teacher'] }}>Código</th>
                    <th scope="col">Color</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($signatures as $signature)
                    <tr>
                        <th scope="row">{{ $signature['num'] }}</th>
                        <td>{{ $signature['nombre'] }}</td>
                        <td {{ $hid['teacher'] }}>{{ $signature['codigo'] }}</td>
                        <td>
                            <div class="color-square" style="background-color: {{ $signature['Color'] }};"></div>
                        </td>
                        <td>
                            <a type="button" class="btn btn-warning" href="{{ route('estudiante', ['id' => $signature['idAsig']]) }}">
                                <x-bi-eye-fill />
                            </a> 
                            {{-- <a type="button" class="btn btn-danger"
                                href="{{ route('delAsignatura', ['id' => $signature['idAsig']]) }}">
                                <x-bi-trash-fill />
                            </a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
