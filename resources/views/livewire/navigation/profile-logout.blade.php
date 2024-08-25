<div class="hidden sm:flex sm:items-center sm:ml-6">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                <div x-data="{ name: '{{ auth()->user()->name }}' }" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">
            <!-- Profile link -->
            <x-dropdown-link :href="route('profile')" wire:navigate>
                {{ __('Profile') }}
            </x-dropdown-link>

            <!-- Authentication -->
            <button wire:click="logout" class="w-full text-start">
                <x-dropdown-link>
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </button>
        </x-slot>
    </x-dropdown>
</div>

<!-- Responsive Navigation Menu for smaller screens -->
<div class="sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate>
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
    </div>

    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 border-t border-gray-200">
        <div class="px-4">
            <div class="font-medium text-base text-gray-800" x-data="{ name: '{{ auth()->user()->name }}' }" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
            <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
        </div>

        <div class="mt-3 space-y-1">
            <x-responsive-nav-link :href="route('profile')" wire:navigate>
                {{ __('Profile') }}
            </x-responsive-nav-link>

            <!-- Authentication -->
            <button wire:click="logout" class="w-full text-start">
                <x-responsive-nav-link>
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </button>
        </div>
    </div>
</div>
