@include('layouts.Assets')
<main>
    <form method="POST" action="{{route('register')}}">

        @csrf

    <a href="{{route('Genesis')}}" type="button" class="btn volver-button">
    <i class="bi bi-arrow-left"></i>
        Volver
    </a>
        <div class="ct">
            <div class="card c-round body-c">
                <br />
                <div class="card-body">
                    <h2 class="card-title text-c">Registro</h2>
                    <br />
                    <div class="row mb-3">
                        <div class="col">
                        <label for="name" class="form-label text-c">Nombre</label>
                            <input type="text" id="name" class="form-control" placeholder="Nombre" aria-label="First name" name="name">
                        </div>
                        <div class="col">
                        <label for="lastname" class="form-label text-c">Apellido</label>
                            <input type="text" id="lastname" class="form-control" placeholder="Apellido" aria-label="Last name" name="lastName">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label text-c">Correo</label>
                        <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Ingrese su correo" name="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label text-c">Contraseña</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Ingrese su contraseña" name="password">
                    </div>
                    <div class="container">
                    </div>
                    <div class="mb-3" style="text-align: center;">
                        <br />
                        <button type="submit" class="btn btn-p" style="text-align: center;">Registrar</button>
                    </div>
                </div>
            </div>
    </form>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success')}}
        </div>
    @endif
</main>