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
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Seen
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Solved
                                </th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @for($i=0; $i<count($messages);$i++)
                                <form action="{{ route('dashboard') }}" method="post">
                                    @csrf
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $messages[$i]->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $messages[$i]->description }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $messages[$i]->seen }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $messages[$i]->solved }}</td>



                                    </tr>

                                </form>
                            @endfor
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
