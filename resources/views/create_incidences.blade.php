<x-guest-layout>
    <form method="POST" action="{{ route('create_incidence') }}">
        @csrf

        <!-- Name -->


        <div>
            <x-input-label for="id" :value="__('Codigo de incidencia')" />
            <x-text-input id="id" class="block mt-1 w-full" type="number" name="id"  required autofocus  />
        </div>

        <div>
            <x-input-label for="description" :value="__('Name')" />
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"  required autofocus  />
        </div>





        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
</x-guest-layout>
