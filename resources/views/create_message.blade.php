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
            <textarea id="description" class="block mt-1 w-full" name="description" required rows="4"></textarea>
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
                <option style="color: whitesmoke; background-color: blue" value="abierta">abierta</option>
                <option style="color: black; background-color: yellow" value="en proceso">en proceso</option>
                <option style="color: black; background-color: greenyellow" value="solucionado">solucionado</option>
            </select>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">{{ __('Register') }}</x-primary-button>
        </div>
    </form>

    <!-- jQuery and JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/changeColor.js') }}" defer></script>
    <script>
        var userJob = {{ auth()->user()->job }};

        $(document).ready(function() {
            if (userJob == 3) {
                $('#estado').prop('disabled', true);
            }

            $('#id_department').change(function() {
                var departmentId = $(this).val();
                var $selectAula = $('#id_aula');
                var originalAulas = $selectAula.html(); // Save the original options

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
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error al recuperar las aulas:', errorThrown);
                        $selectAula.prop('disabled', false).html($selectAula.data('original-html'));
                    }
                });
            });

            $('#id_message').change(function() {
                var messageId = $(this).val();
                var initialDepartmentState = $('#id_department').prop('disabled') && $('#id_department').html();
                var initialAulaState = $('#id_aula').prop('disabled') && $('#id_aula').html();

                if (messageId) {
                    $.ajax({
                        url: '{{ route("message.details", ":id") }}'.replace(':id', messageId),
                        type: 'GET',
                        success: function(response) {
                            $('#id_department').prop('disabled', true).empty();
                            $('#id_aula').prop('disabled', true).empty();
                            $('#id_department').append('<option value="' + response.department_id + '">' + response.department_name + '</option>');
                            $('#id_aula').append('<option value="' + response.aula_id + '">' + response.aula_name + '</option>');
                            $('#estado').val(response.estado);
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.error('Error al recuperar los datos:', errorThrown);
                            $('#id_department').prop('disabled', initialDepartmentState).html(initialDepartmentState);
                            $('#id_aula').prop('disabled', initialAulaState).html(initialAulaState);
                        }
                    });
                } else {
                    $('#id_department').prop('disabled', initialDepartmentState).html(initialDepartmentState);
                    $('#id_aula').prop('disabled', initialAulaState).html(initialAulaState);
                }
            });
        });
    </script>
</x-guest-layout>
