<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <x-nav-link :href="route('create_message')">
                {{ __('Crear mensajes') }}
            </x-nav-link>


        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

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
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                {{app("debugbar")->info($messages)}}
                                @for($i=0; $i<count($messages);$i++)
                                    @php
                                        $aula = \App\Models\Aula::find($messages[$i]->id_aula);
                                        $department = \App\Models\Department::find($messages[$i]->id_department);
                                    @endphp
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $messages[$i]->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $messages[$i]->id_incidence }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $messages[$i]->id_incidence}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $messages[$i]->id_incidence }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $messages[$i]->user }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{  $messages[$i]->estado }}</td>


                                    </tr>

                                @endfor
                            </tbody>
                            @show
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
