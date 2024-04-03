<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>



        <div class="mt-4">
            <x-input-label for="incidence" :value="__('Determina incidencia')" />
        <select name="incidence" id="incidence" >
            {{app("debugbar")->info($incidencies)}}
            @for($i=0;$i<count($incidencies);$i++)

                <option> {{ $incidencies[$i]->id."  ".$incidencies[$i]->description  }} </option>
            @endfor
        </select>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
