@include('layouts.Assets_P')
<main>
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>{{ $actividad->title }}</h1>
            </div>
        </div>
    </div>
    <hr style="background-color: #735AB6">
    <br />
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                <span id="success-message">Mensaje</span>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-success">
                {{ session('error') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Calificación</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($student as $estudiantes)
                    <tr>
                        <th scope="row">{{ $estudiantes['num'] }}</th>
                        <td>{{ $estudiantes['nombre'] }}</td>
                        <td>{{ $estudiantes['apellido'] }}</td>
                        <td><a href="{{ asset('/uploads/' . $estudiantes['archivo']) }}"
                                target="_blank">{{ $estudiantes['archivo'] }}</a></td>
                        <td data-id="{{ $estudiantes['id'] }}">
                            <form action="{{ route('actualizarcal', ['id' => $estudiantes['id']]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input style="width: 20%;" type="number" id="score" name="score"
                                    value="{{ $estudiantes['score'] }}" class="form-control">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-light" id="savebutton{{ $estudiantes['id'] }}"
                                disabled>Guardar</button>
                        </td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var successMessageElement = document.getElementById('success-message');
        $(document).ready(function() {
            // Escucha el evento 'submit' del formulario
            $('form').on('submit', function(e) {
                e.preventDefault();

                const form = $(this);
                const id = form.find('td').data('id');
                const inputValue = form.find('input[name="score"]').val().trim();
                const miBoton = $("#savebutton" + id);

                // Envía una solicitud AJAX al servidor
                $.ajax({
                    type: "PUT",
                    url: form.attr("action"),
                    data: {
                        score: inputValue,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('body').append(
                            '<div class="alert alert-success"><span id="success-message">Actualizado correctamente</span></div>'
                            );
                        miBoton.prop('disabled', true);
                    },
                    error: function(error) {
                        alert("Ocurrió un error al realizar la actualización: " + error
                            .statusText);
                    }
                });
            });

            // Escucha el evento 'input' en el campo de entrada
            $('input[name="score"]').on('input', function() {
                const inputValue = $(this).val().trim();
                const id = $(this).closest('td').data('id');
                const miBoton = $("#savebutton" + id);

                // Habilita o deshabilita el botón según si el valor del campo no está vacío
                if (inputValue !== '') {
                    miBoton.prop('disabled', false);
                } else {
                    miBoton.prop('disabled', true);
                }
            });
        });
    </script>
</main>
