@include('layouts.Assets')
<main>
    <form method="POST" action="{{route('logIn')}}">
        
        @csrf

        <div class="ct">
            <div class="card c-round">
                <div class="row g-0">
                    <div class="col-md-4 ct-imagen">
                        <img src="https://cdn-icons-png.flaticon.com/512/4697/4697260.png" class="img-fluid rounded-start">
                    </div>
                    <div class="col-12 col-sm-8 body-c">
                        <br />
                        <div class="card-body">
                            <h2 class="card-title text-c">Iniciar Sesión</h2>
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label text-c">Correo</label>
                                <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Ingrese su correo" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="inputPassword" class="form-label text-c">Contraseña</label>
                                <input type="password" class="form-control" id="inputPassword" placeholder="Ingrese su contraseña" name="password">
                            </div>
                            <div class="container">
                            <div class="row">
                                <div class="form-check col-md-auto">
                                    <input type="checkbox" class="form-check-input" id="check1">
                                    <label class="form-check-label text-c" for="check1">Recordarme</label>
                                </div>
                                <div class="col" style="text-align: end;">
                                        <a href="#" class="text-c" for="forgot">¿Se te olvido la contraseña?</a>
                                    </div>
                            </div>
                            </div>
                            <div class="mb-3" style="text-align: center;">
                            <br />
                            <button type="submit" class="btn btn-p" style="text-align: center;">Submit</button>
                            </div>
                            
                            <div class="mb-3" style="text-align: center;">
                                <label class="text-c" for="forgot">¿No tienes cuenta?</label>
                                <a href="registro" class="text-c" for="forgot">Registrate</a>
                            </div>
                        </div>
                        <br />
                    </div>
                </div>
            </div>
    </form>
    @if($errors->any())
        <div class="alert alert-danger">
            {{$errors->first('error')}}
        </div>
    @endif
</main>