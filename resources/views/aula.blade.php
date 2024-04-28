<x-guest-layout>
    <form method="POST" action="{{ route('aula') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus  />

        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="department" :value="__('department')"/>
            <select name="department" id="department" required>
                @for($i=0;$i<count($department);$i++)

                    <option
                        value="{{$department[$i]->id}}"> {{ $department[$i]->id."  ".$department[$i]->name  }} </option>
                @endfor
            </select>

        </div>



        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
