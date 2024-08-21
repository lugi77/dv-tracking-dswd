<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('layouts.guest')]
class OtpVerify extends Component
{
    public string $otp = '';

    public function verifyOtp()
    {
        $user = Auth::user();

        if ($user->otp !== $this->otp || now()->greaterThan($user->otp_expires_at)) {
            throw ValidationException::withMessages([
                'otp' => __('The OTP code is invalid or has expired.'),
            ]);
        }

        $user->otp_verified = true;
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.otp-verify');
    }
}
