<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" id="logo-link">
                        <img src="{{ asset('img/volver.png') }}" id="logo-img" style="display: block;" width="50px" alt="Descripción de la imagen">
                    </a>
                    <input type="file" id="logo-input" class="hidden">
                    <button id="logo-toggle-button">Editar Logo</button>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" id="nav-link">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <input type="text" id="nav-input" class="hidden">
                    @if(auth()->user()->job==1) @endif
                    <button id="toggle-button">Editar</button>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 111.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var $navLink = $('#nav-link');
            var $navInput = $('#nav-input');
            var $toggleButton = $('#toggle-button');

            var $logoLink = $('#logo-link');
            var $logoImg = $('#logo-img');
            var $logoInput = $('#logo-input');
            var $logoToggleButton = $('#logo-toggle-button');

            // Cargar el estado inicial del texto desde localStorage
            if (localStorage.getItem('navText')) {
                $navLink.text(localStorage.getItem('navText'));
            }

            // Cargar el estado inicial de la edición desde localStorage
            if (localStorage.getItem('isEditing') === 'true') {
                $navLink.addClass('hidden');
                $navInput.val($navLink.text()).removeClass('hidden').focus();
                $toggleButton.text('Guardar');
            } else {
                $navLink.removeClass('hidden');
                $navInput.addClass('hidden');
                $toggleButton.text('Editar');
            }

            $toggleButton.on('click', function() {
                if ($navLink.is(':visible')) {
                    // Cambiar de texto a input
                    $navInput.val($navLink.text());
                    $navLink.addClass('hidden');
                    $navInput.removeClass('hidden').focus();
                    $toggleButton.text('Guardar');
                    localStorage.setItem('isEditing', 'true');
                } else {
                    // Cambiar de input a texto
                    var newText = $navInput.val();
                    $navLink.text(newText);
                    $navInput.addClass('hidden');
                    $navLink.removeClass('hidden');
                    $toggleButton.text('Editar');
                    localStorage.setItem('isEditing', 'false');
                    localStorage.setItem('navText', newText);
                }
            });

            // Cambiar de input a texto al presionar Enter
            $navInput.on('keypress', function(e) {
                if (e.which == 13) { // Enter key
                    var newText = $navInput.val();
                    $navLink.text(newText);
                    $navInput.addClass('hidden');
                    $navLink.removeClass('hidden');
                    $toggleButton.text('Editar');
                    localStorage.setItem('isEditing', 'false');
                    localStorage.setItem('navText', newText);
                }
            });

            // Editar logo
            $logoToggleButton.on('click', function() {
                $logoInput.click();
            });

            $logoInput.on('change', function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var newLogo = e.target.result;
                    $logoImg.attr('src', newLogo);
                    localStorage.setItem('logoSrc', newLogo);
                }
                reader.readAsDataURL(this.files[0]);
            });

            // Cargar el logo desde localStorage
            if (localStorage.getItem('logoSrc')) {
                $logoImg.attr('src', localStorage.getItem('logoSrc'));
            }
        });
    </script>
</nav>
