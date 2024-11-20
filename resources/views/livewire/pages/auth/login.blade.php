<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Validation\ValidationException;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
{
    $this->validate();

    try {
        $this->form->authenticate();
        Session::regenerate();
        $this->redirect(route('otp-verify'));
    } catch (ValidationException $e) {
        session()->flash('message', $e->getMessage());
    }
}
}; ?>

<div class="login-bg min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg login-container">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        @if (session('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mb-4 text-green-600">
                    {{ session('message') }}
                </div>
        @endif

        <!-- Loading state with spinning circle for "Generating OTP" -->
        <div wire:loading wire:target="login" class="mb-4 font-medium text-center text-sm text-blue-600">
            <svg class="inline mr-2 w-6 h-6 text-blue-600 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.963 7.963 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Generating OTP...
        </div>

        <form wire:submit.prevent="login">
            @csrf

            <!-- DSWD ID -->
            <div>
                <x-input-label for="dswd_id" :value="__('DSWD ID')" />
                <x-text-input wire:model="form.dswd_id" id="dswd_id" class="block mt-1 w-full" type="text" name="dswd_id" required autofocus autocomplete="dswd_id" />
                <x-input-error :messages="$errors->get('form.dswd_id')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}" wire:navigate>
                    {{ __('Create Account') }}
                </a>

                <x-primary-button class="ms-3" wire:loading.attr="disabled">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
        <style>
            .login-bg {
                background-image: url('{{ asset('/img/dswd.png') }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .login-container {
                margin-top: 400px; /* Adjust this value as needed */
            }
        </style>
    </div>
</div>