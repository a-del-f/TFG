<x-guest-layout>
    <form method="POST" action="{{ route('delete_department') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="department" :value="__('Department ')" />

            <select  id="department" class="block mt-1 w-full" type="text" name="department"  >
                @foreach($departments as $department)
                <option >{{$department->id." ".$department->name}}</option>
                @endforeach
            </select>
            @if(isset($errorMessage))
                <x-input-error :messages="$errorMessage" class="mt-2" />
            @endif
        </div>


        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ms-4">
                {{ __('Eleminar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
