@php use App\Models\Aula; @endphp
@php use App\Models\Department; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <x-nav-link :href="route('creator_message')" title="Crear incidencias">
                <img src="{{ asset('icons/envelope-plus-fill.svg') }}" id="logo-img" style="display: block;" width="30px" alt="Crear incidencias">

            </x-nav-link>
            @if(auth()->user()->job!=3)
            <x-nav-link :href="route('incidences')" title="Tipos de incidencias">
                <img src="{{ asset('icons/envelope-exclamation-fill.svg') }}" id="logo-img" style="display: block;" width="30px" alt="Tipos de incidencias">
            </x-nav-link>
            @endif
        </h2>
    </x-slot>

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Segundo div con los checkboxes -->
                <div class="flex justify-end mt-4 mr-4"> <!-- Agregamos 'mt-4' para espacio superior -->
                    <form method="get" action="{{ route('messages') }}" class="flex space-x-4">
                        @csrf
                        <div class="flex items-center space-x-2">
                            <x-input-label for="fecha" :value="__('Fecha')"></x-input-label>
                            <input type="checkbox" id="fecha" name="fecha" class="form-checkbox">
                        </div>
                        <div class="flex items-center space-x-2">
                            <x-input-label for="estado" :value="__('Estado')"></x-input-label>
                            <input type="checkbox" id="estado" name="estado" class="form-checkbox">
                        </div>
                        <div class="flex items-center justify-center sm:justify-start">
                            <x-primary-button>
                                {{ __('Ordenar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
                <!-- Primer div con los mensajes por estado -->
                <div class="flex flex-wrap">
                    @foreach($messagesByState as $estado => $count)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-2 m-2">
                            <div><strong>Estado:</strong> {{ $estado }}</div>
                            <div><strong>Cantidad de Mensajes:</strong> {{ $count }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100">
                        @section('tabla')
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Incidencia
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Departamento
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aula
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Usuario
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Estado
                                    </th>
                                    <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                {{ app("debugbar")->info($messages) }}
                                @foreach($messages as $message)
                                    @php
                                        $aula = App\Models\Aula::find($message->id_aula);
                                        $department = App\Models\Department::find($message->id_department);
                                        // Escapar el campo de descripción
                                        $escapedDescription = htmlspecialchars($message->description, ENT_QUOTES, 'UTF-8');
                                    @endphp
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                        <x-nav-link :href="route('creator_message',$message->id_message)" title="Crear incidencias">
                                            {{ $message->id_message }}
                                        </x-nav-link></td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $message->incidences->description }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $department->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $aula->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $message->users->name." ".$message->users->surname }}</td>
                                        @if(auth()->user()->job != 2)
                                            @if($message->estado=="abierta")
                                            <td class="px-6 py-4 whitespace-nowrap"> <svg width="100" height="100">
                                                    <circle cx="50" cy="50" r="25" fill="blue" />
                                                </svg></td>
                                            @elseif($message->estado=="en proceso")
                                                <td class="px-6 py-4 whitespace-nowrap"> <svg width="100" height="100">
                                                        <circle cx="50" cy="50" r="25" fill="yellow" />
                                                    </svg></td>
                                            @elseif($message->estado=="solucionado")
                                                <td class="px-6 py-4 whitespace-nowrap"> <svg width="100" height="100">
                                                        <circle cx="50" cy="50" r="25" fill="green" />
¡                                                    </svg></td>
                                            @endif
                                            @endif
                                        @if(auth()->user()->job == 2)
                                            <form method="post" action="{{ route('messages') }}">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @csrf
                                                    @method("put")
                                                    <div class="select-wrapper mt-4">
                                                        <select name="estado" class="estado" required>
                                                            <option @if($message->estado=="abierta") selected @endif style="color: whitesmoke; background-color: blue" value="abierta">abierta</option>
                                                            <option @if($message->estado=="en proceso") selected @endif style="color: black; background-color: yellow" value="en proceso">en proceso</option>
                                                            <option @if($message->estado=="solucionado") selected @endif style="color: black; background-color: greenyellow" value="solucionado">solucionado</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                        <input type="hidden" name="id_message" value="{{ $message->id_message }}">
                                                        <button type="submit">
                                                            {{ __('Create') }}
                                                        </button>
                                                </td>
                                            </form>
                                        @endif
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <button class="open-modal-button" data-message-id="{{ $message->id_message }}" data-description="{{ $escapedDescription }}" data-user="{{ $message->user }}" data-fecha="{{ $message->fecha_creacion }}">
                                                Ver tabla
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @show
                    </div>
                </div>
            </div>
        </div>

    <div class="modal" id="modal-tabla">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Título de la ventana emergente</h4>
            </div>
            <div class="modal-body">
                <table>
                    <thead>
                    <tr>
                        <th class="px-4">Fecha</th>
                        <th class="px-4">Usuario</th>
                        <th class="px-4">Descripción</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="{{ asset('js/changeColor.js') }}" defer></script>

    <script>
        $(document).ready(function () {
            $('.open-modal-button').click(function () {
                var messageId = $(this).data('message-id');

                // Realizar una solicitud AJAX para obtener los detalles del mensaje
                $.ajax({
                    url: '{{ route("message.information", ":id") }}'.replace(':id', messageId),
                    type: 'GET',
                    success: function (response) {
                        var message = response.message;

                        // Rellenar la ventana modal con la información del mensaje y sus incidencias
                        $('#modal-tabla tbody').empty();
                        $('#modal-tabla tbody').append('<tr><td class="px-4">' + message.fecha + '</td><td class="px-4">' + message.user + '</td><td class="px-4"><textarea class="block mt-1 w-full" name="description" required rows="4" readonly>' + message.description + '</textarea></td></tr>');



                        // Mostrar la ventana modal
                        $('#modal-tabla').modal();
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.error('Error al obtener los detalles del mensaje:', errorThrown);
                    }
                });
            });
        });
    </script>



</x-app-layout>
