<x-guest-layout>
    <form method="POST" action="{{ route('create_message') }}">
        @csrf

        <!-- Description -->
        <div class="mt-4">

            <input type="hidden" name="id_message" id="id_message" value="{{$id}}">

        </div>

        <div class="mt-4">
            <x-input-label for="id_incidence" :value="__('Incidence')"/>
            <select name="id_incidence" id="id_incidence">
                @foreach($incidencies as $incidence)
                    <option value="{{ $incidence->id }}">{{  $incidence->description }}</option>
                @endforeach
            </select>
            <input type="hidden" name="id_incidence_hidden" id="id_incidence_hidden" value="">

        </div>

        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')"/>
            <textarea id="description" class="block mt-1 w-full" name="description" required rows="4"></textarea>
        </div>

        <!-- Incidence -->


        <!-- Department -->
        <div class="mt-4">
            <x-input-label for="id_department" :value="__('Department')"/>
            <select name="id_department" id="id_department" required>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
            <input type="hidden" name="id_department_hidden" id="id_department_hidden" value="">
        </div>

        <!-- Aula -->
        <div class="mt-4">
            <x-input-label for="id_aula" :value="__('Aula')"/>
            <select name="id_aula" id="id_aula" required>
                @foreach($aula as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </select>
            <input type="hidden" name="id_aula_hidden" id="id_aula_hidden" value="">
        </div>

        <!-- Estado -->
        <div class="select-wrapper mt-4">
            <x-input-label for="estado" :value="__('Estado')"/>
            <select name="estado" id="estado" required>
                <option style="color: whitesmoke; background-color: blue" value="abierta">abierta</option>
                <option style="color: black; background-color: yellow" value="en proceso">en proceso</option>
                <option style="color: black; background-color: greenyellow" value="solucionado">solucionado</option>
            </select>
            <input type="hidden" name="estado_hidden" id="estado-hidden" value="">
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">{{ __('Register') }}</x-primary-button>
        </div>
    </form>

    <!-- jQuery and JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            var initialDepartmentState = $('#id_department').html();
            var initialAulaState =  $('#id_aula').html();
            var initialIncidenceState =  $('#id_incidence').html();

            var userJob = {{ auth()->user()->job }};

            if (userJob == 3) {
                $('#estado').prop('disabled', true);
            }

            function updateHiddenFields() {
                $('#estado-hidden').val($('#estado').val());
                $('#id_department_hidden').val($('#id_department').val());
                $('#id_aula_hidden').val($('#id_aula').val());
                $('#id_incidence_hidden').val($('#id_incidence').val());

            }

            $('#id_department').change(function() {
                var departmentId = $(this).val();
                var $selectAula = $('#id_aula');
                var originalAulas = $selectAula.html();

                $selectAula.prop('disabled', true).data('original-html', originalAulas).html('<option value="">Cargando aulas...</option>');

                $.ajax({
                    url: '{{ route('aulas.department', ':id') }}'.replace(':id', departmentId),
                    type: 'GET',
                    success: function(data) {
                        $selectAula.empty();
                        $.each(data, function(index, aula) {
                            $selectAula.append('<option value="' + aula.id + '">' + aula.name + '</option>');
                        });
                        $selectAula.prop('disabled', false).data('original-html', $selectAula.html());
                        updateHiddenFields();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error al recuperar las aulas:', errorThrown);
                        $selectAula.prop('disabled', false).html($selectAula.data('original-html'));
                        updateHiddenFields();
                    }
                });
            });

            $('#id_message').change(function() {
                var messageId = $(this).val();


                if (messageId) {
                    $.ajax({
                        url: '{{ route("message.details", ":id") }}'.replace(':id', messageId),
                        type: 'GET',
                        success: function(response) {
                            $('#id_department').prop('disabled', true).empty();
                            $('#id_aula').prop('disabled', true).empty();
                            $('#id_incidence').prop('disabled', true).empty();
                            $('#estado').prop('disabled', true);
                            $('#id_department').append('<option value="' + response.department_id + '">' + response.department_name + '</option>');
                            $('#id_aula').append('<option value="' + response.aula_id + '">' + response.aula_name + '</option>');
                            $('#id_incidence').append('<option value="' + response.incidence_id + '">' + response.incidence_name + '</option>');
                            $('#estado').val(response.estado);
                            updateHiddenFields();
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.error('Error al recuperar los datos:', errorThrown);
                            $('#id_department').prop('disabled', initialDepartmentState).html(initialDepartmentState);
                            $('#id_aula').prop('disabled', initialAulaState).html(initialAulaState);
                            updateHiddenFields();
                        }
                    });
                } else {
                    $('#id_department').prop('disabled', false).html(initialDepartmentState);
                    $('#id_aula').prop('disabled', false).html(initialAulaState);
                    $('#id_incidence').prop('disabled', false).html(initialIncidenceState);
                    $('#estado').prop('disabled',false).val('abierta'); // Establecer el estado en "abierta" cuando messageId es null
                    updateHiddenFields();
                }
            });

            $('#estado').change(updateHiddenFields);
            $('#id_department').change(updateHiddenFields);
            $('#id_aula').change(updateHiddenFields);
            $('#id_incidence').change(updateHiddenFields);

            updateHiddenFields();
        });
    </script>
</x-guest-layout>
