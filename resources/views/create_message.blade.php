<x-guest-layout>
    <form method="POST" action="{{ route('create_message') }}">
        @csrf

        <!-- Description -->
        <div class="mt-4">
            <x-input-label for="id_message" :value="__('Id de hilo')"/>
            <select name="id_message" id="id_message">
                <option value="{{ null }}">Nuevo hilo</option>

            @foreach($messageIds as $message)
                    <option value="{{ $message }}">{{ $message }}</option>
                @endforeach
            </select>
        </div>


        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')"/>
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" required/>

        </div>

        <!-- Incidence -->
        <div class="mt-4">
            <x-input-label for="id_incidence" :value="__('Incidence')"/>
            <select name="id_incidence" id="id_incidence">
                @foreach($incidencies as $incidence)
                    <option value="{{ $incidence->id }}">{{ $incidence->id . " " . $incidence->description }}</option>
                @endforeach
            </select>
        </div>

        <!-- Department -->
        <div class="mt-4">
            <x-input-label for="id_department" :value="__('Department')"/>
            <select name="id_department" id="id_department" required>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{  $department->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Aula -->
        <div class="mt-4">
            <x-input-label for="id_aula" :value="__('Aula')"/>
            <select name="id_aula" id="id_aula" required>
                @foreach($aula as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Estado -->
        <div class="select-wrapper mt-4">
            <x-input-label for="estado" :value="__('Estado')"/>
            <select name="estado" id="estado" required>
                <option style=" color: whitesmoke; background-color: blue" value="abierta">abierta</option>
                <option style=" color: black; background-color: yellow" value="en proceso">en proceso</option>
                <option style=" color: black; background-color: greenyellow" value="solucionado">solucionado</option>
            </select>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">{{ __('Register') }}</x-primary-button>
        </div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/changeColor.js') }}" defer></script>

    <script>
        $(document).ready(function() {
            $('#id_department').change(function() {
                var departmentId = $(this).val();
                var $selectAula = $('#id_aula');
                var originalAulas = $selectAula.html(); // Guardar las opciones originales

                // Deshabilitar el menú desplegable de "Aula" y mostrar un mensaje de carga
                $selectAula.prop('disabled', true).data('original-html', originalAulas).html('<option value="">Cargando aulas...</option>');

                // Hacer una solicitud AJAX al servidor para recuperar las aulas asociadas al departamento seleccionado
                $.ajax({
                    url: '{{ route('aulas.department', ':id') }}'.replace(':id', departmentId),
                    type: 'GET',
                    success: function(data) {
                        // Limpiar las opciones actuales del menú desplegable de "Aula"
                        $selectAula.empty();

                        // Agregar las nuevas opciones de "Aula" al menú desplegable
                        $.each(data, function(index, aula) {
                            $selectAula.append('<option value="' + aula.id + '">' + aula.name + '</option>');
                        });

                        // Habilitar el menú desplegable de "Aula" y restaurar el mensaje de carga
                        $selectAula.prop('disabled', false).data('original-html', $selectAula.html());
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error al recuperar las aulas:', errorThrown);

                        // Restaurar las opciones originales del menú desplegable de "Aula" y habilitarlo
                        $selectAula.prop('disabled', false).html($selectAula.data('original-html'));
                    }
                });
            });
        });




    </script>
<script>
    $(document).ready(function() {
        // Guardar el estado inicial de los select de departamento y aula
        var initialDepartmentState = $('#id_department').prop('disabled') && $('#id_department').html();
        var initialAulaState = $('#id_aula').prop('disabled') && $('#id_aula').html();

        $('#id_message').change(function() {
            var messageId = $(this).val();

            if (messageId!=null) {
                // Si se selecciona una opción con valor, deshabilitar y limpiar los select de departamento y aula

                console.log('{{ route("message.details", ":id") }}'.replace(':id', messageId));
                // Hacer una solicitud AJAX al servidor para recuperar el departamento y el aula correspondientes
                $.ajax({

                    url: '{{ route("message.details", ":id") }}'.replace(':id', messageId),
                    type: 'GET',
                    success: function(response) {
                        $('#id_department').prop('disabled', true).empty();
                        $('#id_aula').prop('disabled', true).empty();
                        // Asignar el departamento y el aula correspondientes a los select
                        $('#id_department').append('<option value="' + response.department_id + '">' + response.department_name + '</option>');
                        $('#id_aula').append('<option value="' + response.aula_id + '">' + response.aula_name + '</option>');


                        // Asignar el estado correspondiente al select
                        $('#estado').val(response.estado);

                        // Habilitar los select de departamento y aula
                        $('#id_department').prop('disabled', true);
                        $('#id_aula').prop('disabled', true);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error al recuperar los datos:', errorThrown);

                        // Restaurar el estado inicial de los select de departamento y aula en caso de error
                        $('#id_department').prop('disabled', initialDepartmentState).html(initialDepartmentState);
                        $('#id_aula').prop('disabled', initialAulaState).html(initialAulaState);
                    }
                });
            } else {
                // Si se selecciona la opción "Nuevo hilo" o el valor es null, restaurar el estado inicial de los select de departamento y aula
                $('#id_department').prop('disabled', initialDepartmentState).html(initialDepartmentState);
                $('#id_aula').prop('disabled', initialAulaState).html(initialAulaState);
            }
        });
    });


</script>



</x-guest-layout>
