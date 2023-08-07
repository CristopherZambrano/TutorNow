@include('layouts.Assets_P')
<main>
    <form>
        <div class="container">
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