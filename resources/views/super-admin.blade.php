<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <x-nav-link :href="route('register')" title="Registrar Usuarios">
                <img src="{{ asset('icons/person-fill-add.svg') }}" id="logo-img" style="display: block;" width="30px" alt="Registrar Usuarios">
            </x-nav-link>
            <x-nav-link :href="route('departments')" title="Registrar Departamentos">
                <img src="{{ asset('icons/building-fill-add.svg') }}" id="logo-img" style="display: block;" width="30px" alt="Registrar Departamentos">
            </x-nav-link>
            <x-nav-link :href="route('delete_department')" title="Eliminar Departamentos">
                <img src="{{ asset('icons/building-fill-dash.svg') }}" id="logo-img" style="display: block;" width="30px" alt="Eliminar Departamentos">
            </x-nav-link>
            <x-nav-link :href="route('aula')" title="Registrar Aula">
                <img src="{{ asset('icons/door-open-fill.svg') }}" id="logo-img" style="display: block;" width="30px" alt="Registrar Aula">
            </x-nav-link>
            <x-nav-link :href="route('messages')" title="Ver mensajes">
                <img src="{{ asset('icons/envelope-paper-fill.svg') }}" id="logo-img" style="display: block;" width="30px" alt="Ver mensajes">
            </x-nav-link>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{ $users->links() }}

                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Apellido
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Función
                                </th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            {{app("debugbar")->info("$users")}}
                            @for($i=0; $i<count($users);$i++)
                                <form action="{{ route('redirect') }}" method="post">
                                    @csrf
                                    @method("put")
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $users[$i]->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $users[$i]->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $users[$i]->surname }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $users[$i]->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">

                                                     @if($users[$i]->job!=1)
                                                <select name="job"
                                                        class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                                    @for($r=1;$r<count($functions);$r++)
                                                        <option value="{{$functions[$r]->id}}"
                                                                @if($functions[$r]->id==$users[$i]->job) selected @endif>{{$functions[$r]->name}}</option>
                                                    @endfor
                                                </select>


                                        </td>
                                        <td>

                                                <input type="hidden" name="id" value="{{$users[$i]->id}}">
                                            <input type="submit" name="btn">

                                            @else
                                                {{"Super Admin"}}
                                            @endif

                                        </td></form>
                                <form action="{{route('redirect')}}" method="post" >
                                    @csrf
                                    @method("delete")
                                        @if($users[$i]->job!=1)
                                        <td>
                                            <input type="hidden" name="id" value="{{$users[$i]->id}}">

                                            <input type="submit" value="Eleminar" name="eleminar">

                                        </td>@endif
                                </form>
                                    </tr>

                            @endfor
                            </tbody>
                        </table>

                        <div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
