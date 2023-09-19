@include('layouts.Assets_P')
<main>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Cambio de contraseña</h1>
            </div>
        </div>
    </div>
    <hr style="background-color: #735AB6">
    <form method="POST" action="{{route('changePassword')}}">
        @csrf
        <div class="ct">
            <div class="card c-round body-c">
                <br />
                <div class="card-body">
                    <h2 class="card-title text-c">Ingrese las nueva contraseñas</h2>
                    <br />
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label text-c">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Ingrese su contraseña" name="password">
                            <div class="input-group-text">
                                <x-bi-eye id="show-password" style="font-size: 24px; cursor: pointer;" />
                            </div>
                        </div>
                        <label for="inputPassword" class="form-label text-c">Nueva contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="inputNewPassword" placeholder="Ingrese su nueva contraseña" name="newPassword">
                            <div class="input-group-text">
                                <x-bi-eye id="show-password-new" style="font-size: 24px; cursor: pointer;" />
                            </div>
                        </div>
                        <label for="inputPassword" class="form-label text-c">Verificar nueva contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="inputPasswordVer" placeholder="Verifique su nueva contraseña" name="newPasswordV">
                            <div class="input-group-text">
                                <x-bi-eye id="show-password-ver" style="font-size: 24px; cursor: pointer;" />
                            </div>
                        </div>
                    </div>
                    <div class="container">
                    </div>
                    <div class="mb-3" style="text-align: center;">
                        <br />
                        <button type="submit" class="btn btn-p" style="text-align: center;">Cambiar</button>
                    </div>
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
        var icono = document.getElementById("show-password-ver");
        var impPass = document.getElementById("inputPasswordVer");

        icono.addEventListener("mouseover", function() {
            icono.click(); // Simula un clic cuando el mouse pasa por encima
        });
        
        icono.addEventListener("click", function() {
            if (impPass.type === "password") {
                impPass.type = "text"; // Cambia el tipo a "text".
            } else {
                impPass.type = "password"; // Cambia el tipo a "password" si no lo es.
            }
        });
    </script>
    <script>
            var icono2 = document.getElementById("show-password");
            var impPass2 = document.getElementById("inputPassword");
    
            icono2.addEventListener("mouseover", function() {
                icono2.click(); // Simula un clic cuando el mouse pasa por encima
            });
            
            icono2.addEventListener("click", function() {
                if (impPass2.type === "password") {
                    impPass2.type = "text"; // Cambia el tipo a "text".
                } else {
                    impPass2.type = "password"; // Cambia el tipo a "password" si no lo es.
                }
            });
        </script>
        <script>
            var icono3 = document.getElementById("show-password-new");
            var impPass3 <= document.getElementById("inputNewPassword");
    
            icono3.addEventListener("mouseover", function() {
                icono3.click(); // Simula un clic cuando el mouse pasa por encima
            });
            
            icono3.addEventListener("click", function() {
                if (impPass3.type === "password") {
                    impPass3.type = "text"; // Cambia el tipo a "text".
                } else {
                    impPass3.type = "password"; // Cambia el tipo a "password" si no lo es.
                }
            });
        </script>
        
</main>
