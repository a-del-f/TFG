<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <x-nav-link :href="route('register')">
                {{ __('Registrar Usuarios') }}
            </x-nav-link><x-nav-link :href="route('departments')">
                {{ __('Registrar Departamentos') }}
            </x-nav-link>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <x-nav-link :href="route('incidences')">
                    {{ __('Ver incidencias('.count ($incidencias).')') }}
                </x-nav-link><div class="p-6 text-gray-900 dark:text-gray-100">

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Funcion</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        {{app("debugbar")->info("$users")}}
                        @for($i=0; $i<count($users);$i++)
                            <form action="{{ route('dashboard') }}" method="post">
                                @csrf
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $users[$i]->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $users[$i]->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $users[$i]->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($users[$i]->job!=1)

                                    </td>
                                    <td>
                                        <input type="hidden" name="id" value="{{$users[$i]->id}}">
                                        <input type="submit" name="btn">
                                        @else
                                            {{"Super Admin"}}
                                        @endif

                                    </td>

                                </tr>

                            </form>
                        @endfor
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
