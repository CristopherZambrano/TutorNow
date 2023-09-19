<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <nav class="navbar navbar-expand-lg bg-body-tertiary"style="font-size: 18px;" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ asset('Home') }}">
                <img src="https://cdn-icons-png.flaticon.com/512/4697/4697260.png" alt="Logo" width="30"
                    height="24" class="d-inline-block align-text-top">
                TutorNow
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/Home"><x-bi-house-heart-fill />
                            Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ asset('subject') }}"> <x-bi-bookmark-plus /> Clases</a>
                    </li>
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <x-bi-gear-fill />
                                Configuración
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{asset('perfilUser')}}"> <x-bi-person-circle /> Perfil</a></li>
                                <li><a class="dropdown-item" href="{{asset('newPassword')}}"> <x-bi-key /> Contraseña</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/"><x-bi-arrow-left-square-fill /> Salir</a></li>
                            </ul>
                        </li>
                </ul>
            </div>
        </div>
    </nav>
    </br>
