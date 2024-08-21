<div class="max-w-md mx-auto mt-8">
    <h1 class="text-2xl font-semibold mb-6">Enter OTP</h1>

    @if (session('error'))
        <div class="text-red-600 mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="verifyOtp">
        <div class="mb-4">
            <input type="text" wire:model="otp" placeholder="Enter OTP"
                   class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('otp') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition duration-200">
            Verify OTP
        </button>
    </form>
</div>
