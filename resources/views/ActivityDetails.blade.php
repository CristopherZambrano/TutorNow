@include('layouts.Assets_P')
<main>
    <h1>Detalle de la actividad</h1>
    <p>
        {{$activity}}
    </p>
    <h1>Videos relacionados a la actividad</h1>
    <ul>
        @foreach($videos as $video)
            <li>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $video->id->videoId }}" frameborder="0" allowfullscreen></iframe>
            </li>
        @endforeach
    </ul>
</main>