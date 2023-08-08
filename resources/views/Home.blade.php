@include('layouts.Assets_P')
<main>
    <form>
        <div class="container"
         <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <x-bi-plus-circle-fill /> Actividades 
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <h1>Bienvenido a TutorNow</h1>
            <ul>
                @foreach ($activities as $activity)
                <li>
                    id: {{$activity['id']}} <br>
                    Asignatura: {{$activity['Asignatura']}} <br>
                    Descripcion: {{$activity['Descripcion']}} <br>
                    Fecha de entrega: {{$activity['Fecha_Entrega']}} <br>
                    Puntaje: {{$activity['Puntaje']}} <br>
                    Estado: {{$activity['Estado']}} <br>
                </li>
                @endforeach
            </ul>
        </div>
    </form>
</main>