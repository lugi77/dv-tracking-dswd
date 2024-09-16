<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $dswd_id = '';
    public string $section = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'dswd_id' => ['required', 'string', 'unique:users'],
            'section' => ['required', 'in:Budget,Accounting,Cash'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);
    
        $validated['password'] = Hash::make($validated['password']);

        // Map section to integer
        $sectionMapping = [
            'Budget' => 1,
            'Accounting' => 2,
            'Cash' => 3,
        ];

        $validated['section'] = $sectionMapping[$validated['section']];
    
        // Create the user but do not log them in
        $user = User::create(array_merge($validated, ['approved' => false])); // Assuming 'approved' is a boolean field in your users table
    
        // Trigger the Registered event
        event(new Registered($user));
    
        // Store a session message
        session()->flash('message', 'Your account is under review. You will be notified once an admin has approved your account.');
    
        // Redirect to the login page
        $this->redirect(route('login', absolute: false), navigate: true);
    }
}; ?>

<div class="login-bg min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg login-container">

        <div class="text-center mb-6">
            <h1 class="text-lg font-semibold text-gray-800">Create Your Account</h1>
        </div>
        <form wire:submit.prevent="register">
            @csrf <!-- Include CSRF token for security -->

            <!-- Name -->
            <div class="mt-4">
                <x-input-label for="name"  />
                <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" placeholder="Name" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email"  />
                <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" placeholder="Email" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- DSWD ID -->
            <div class="mt-4">
                <x-input-label for="dswd_id" />
                <x-text-input wire:model="dswd_id" id="dswd_id" class="block mt-1 w-full" type="text" name="dswd_id" placeholder="DSWD ID Number" required autocomplete="dswd_id" />
                <x-input-error :messages="$errors->get('dswd_id')" class="mt-2" />
            </div>

            <!-- Section -->
            <div class="mt-4">
                <x-input-label for="section" />
                    <select id="section" name="section" wire:model="section"
                    class="block mt-1 w-full shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded
                    @error('section') border-red-500 @enderror" required>
                    <option value="">Select Section</option>
                    <option value="Budget">Budget</option>
                    <option value="Accounting">Accounting</option>
                    <option value="Cash">Cash</option>
                    </select>
                <x-input-error :messages="$errors->get('section')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" />
                <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password" placeholder="Password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation"  />
                <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
        <style>
            .login-bg {
                background-image: url('{{ asset('/build/assets/img/bg2.png') }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                }
        </style>
    </div>
</div>