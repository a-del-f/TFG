<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">


        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-nav-link :href="route('incidences')">
                        {{ __('Listado de incidencias incidencias') }}
                    </x-nav-link>
                    <x-nav-link :href="route('messages')">
                        {{ __('Ver mensajes('.count ($messages).')') }}



                    </x-nav-link>


                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {!! view('messages')->with('messages', $messages)
                            ->renderSections()['tabla']; !!}                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
