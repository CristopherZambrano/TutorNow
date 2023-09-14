@include('layouts.Assets_P')
<main>
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>{{ $clase->name }}</h1>
            </div>
        </div>
    </div>
    <hr style="background-color: #735AB6">
    <br />
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
                    <th scope="col">Apellido</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($student as $estudiantes)
                    <tr>
                        <th scope="row">{{ $estudiantes['num'] }}</th>
                        <td>{{ $estudiantes['nombre'] }}</td>
                        <td>{{ $estudiantes['apellido'] }}</td>
                        <td>
                            <a type="button" class="btn btn-danger"
                                href="#">
                                <x-bi-trash-fill />
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>