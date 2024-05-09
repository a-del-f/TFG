<x-guest-layout>
    <form method="POST" action="{{ route('create_message') }}">
        @csrf

        <!-- Description -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')"/>
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" required/>
            @error('description')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
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
                <option style=" color: black; background-color: yellow" value="solucionando">en proceso</option>
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


</x-guest-layout>
