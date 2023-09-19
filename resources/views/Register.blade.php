@include('layouts.Assets_LR')
<main>
    <form method="POST" action="{{ route('register') }}">

        @csrf

        <a href="{{ route('Genesis') }}" type="button" class="btn volver-button">
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
                            <input type="text" id="name" class="form-control" placeholder="Nombre"
                                aria-label="First name" name="name">
                        </div>
                        <div class="col">
                            <label for="lastname" class="form-label text-c">Apellido</label>
                            <input type="text" id="lastname" class="form-control" placeholder="Apellido"
                                aria-label="Last name" name="lastName">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label text-c">Correo</label>
                        <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp"
                            placeholder="Ingrese su correo" name="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label text-c">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="inputPassword"
                                placeholder="Ingrese su contraseña" name="password">
                            <div class="input-group-text">
                                <x-bi-eye id="show-password" style="font-size: 24px; cursor: pointer;" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="2" id="teacherCh" name="teacherCh">
                            <label class="form-check-label text-c" for="flexCheckDefault">
                                Profesor
                            </label>
                        </div>
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
    <script>
        var icono = document.getElementById("show-password");
        var impPass = document.getElementById("inputPassword");

        icono.addEventListener("mouseover", function() {
            icono.click();
        });

        icono.addEventListener("click", function() {
            if (impPass.type === "password") {
                impPass.type = "text";
            } else {
                impPass.type = "password";
            }
        });
    </script>
</main>
