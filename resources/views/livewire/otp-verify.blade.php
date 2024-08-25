<div class="login-bg min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg login-container">
        <form wire:submit.prevent="verifyOtp">
            @csrf

            <div>
                <x-input-label for="otp" :value="__('OTP')" />
                <x-text-input wire:model="otp" id="otp" class="block mt-1 w-full" type="text" name="otp" required autofocus autocomplete="one-time-code" />
                <x-input-error :messages="$errors->get('otp')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Verify OTP') }}
                </x-primary-button>
            </div>
    </form>
    <style>
        .login-bg {
        background-image: url('{{ asset('/build/assets/img/dswd.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
            }

    .login-container {
        margin-top: 200px; /* Adjust this value as needed */}
    </style>
    </div>
</div>
