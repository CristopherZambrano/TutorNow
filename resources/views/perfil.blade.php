@include('layouts.Assets_P')
<main>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Perfil del {{ $detalle['detalle']}}</h1>
            </div>
        </div>
    </div>
    <hr style="background-color: #735AB6">
    <div class="container">
        <div class="card card-edit">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col">
                        <dt class="col-sm-3">Nombre</dt>
                            <dd class="col-sm-9">
                                {{ $persona->name }}
                        </dd>
                    </div>
                    <div class="col">
                        <dt class="col-sm-3">Apellido</dt>
                            <dd class="col-sm-9">
                                {{ $persona->lastName }}
                        </dd>
                    </div>
                </div>

                <dt class="col-sm-3">E-mail</dt>
                <dd class="col-sm-9">{{ $persona->user }}</dd>

                <div class="row g-3">
                    <div class="col">
                        <dt class="col-sm-3">Usuario desde</dt>
                            <dd class="col-sm-9">
                                {{ $persona->created_at }}
                        </dd>
                    </div>
                    <div class="col">
                        <dt class="col-sm-3">Modificacion</dt>
                            <dd class="col-sm-9">
                                {{ $persona->updated_at }}
                        </dd>
                    </div>
                </div>

                <dt class="col-sm-3">Clases</dt>
                <dd class="col-sm-9">{{ $detalle['numeroClases'] }}</dd>

            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first('error') }}
        </div>
    @endif
</main>