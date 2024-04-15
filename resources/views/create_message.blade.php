<x-guest-layout>
    <form method="POST" action="{{ route('create_message') }}">
        @csrf

        <!-- Name -->

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('description')" />
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"  required  />

        </div>



        <div class="mt-4">
            <x-input-label for="id_incidence" :value="__('id_incidence')" />
        <select name="id_incidence" id="id_incidence" >
            {{app("debugbar")->info($incidencies)}}
            @for($i=0;$i<count($incidencies);$i++)

                <option value="{{$incidencies[$i]->id}}" > {{ $incidencies[$i]->id."  ".$incidencies[$i]->description  }} </option>
            @endfor
        </select>

        </div>
        <div class="mt-4">
            <x-input-label for="department" :value="__('department')" />
            <select name="department" id="department" >
                {{app("debugbar")->info($department)}}
                @for($i=0;$i<count($department);$i++)

                    <option value="{{$department[$i]->id}}" > {{ $department[$i]->id."  ".$department[$i]->name  }} </option>
                @endfor
            </select>
            @if(isset($errorMessage))
            <x-input-error :messages="$errorMessage" class="mt-2" />
            @endif
        </div>
        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
