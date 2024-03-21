<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Funcion</th>
                        </tr>
                        @for($i=0; $i<count($users);$i++)
                            <tr>
                                <td>{{ $users[$i]->id }}</td>
                                <td>{{ $users[$i]->name }}</td>
                                <td>{{ $users[$i]->email }}</td>
                                <td>  @if($functions[$i]->id==$users[$i]->job )
                                          {{$functions[$i]->name}}
                                @endif  </td>
                            </tr> @endfor

                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
