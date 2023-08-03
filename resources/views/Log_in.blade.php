@include('layouts.Assets')
<main>
    <form method="POST">
        <div class="ct" >
            <div class="card c-round" style="max-width: 60%; ">
                <div class="row g-0 card-pr">
                    <div class="col-md-4 ct-imagen">
                        <img src="https://cdn-icons-png.flaticon.com/512/4697/4697260.png" class="img-fluid rounded-start">
                    </div>
                    <div class="col-sm-8 col-sm-6 body-c">
                        <div class="card-body">
                            <h2 class="card-title text-c">Iniciar Sesión</h2>
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label text-c">Correo</label>
                                <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Ingrese su correo">
                            </div>
                            <div class="mb-3">
                                <label for="inputPassword" class="form-label text-c">Contraseña</label>
                                <input type="password" class="form-control" id="inputPassword" placeholder="Ingrese su contraseña">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="check1">
                                <label class="form-check-label text-c" for="check1">Recordarme</label>
                            </div>
                            <button type="submit" class="btn btn-p">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
</main>