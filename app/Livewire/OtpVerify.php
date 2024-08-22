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

        // Validate OTP
        if ($user->otp !== $this->otp || now()->greaterThan($user->otp_expires_at)) {
            throw ValidationException::withMessages([
                'otp' => __('The OTP code is invalid or has expired.'),
            ]);
        }

        // Clear OTP and its expiry
        $user->otp_verified = true;
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        // Redirect based on user section
        return $this->redirectToDashboard();
    }

    /**
     * Redirect user to their specific dashboard based on their section.
     *
     */
    protected function redirectToDashboard()
    {
        $user = Auth::user();

        if ($user->section === 0) {
            return redirect()->route('admin'); // Admin Dashboard
        } elseif ($user->section === 1) {
            return redirect()->route('budget'); // Budget Dashboard
        } elseif ($user->section === 2) {
            return redirect()->route('accounting'); // Accounting Dashboard
        } elseif ($user->section === 3) {
            return redirect()->route('cash'); // Cash Dashboard
        } else {
            return abort(401, 'Unauthorized');
        }
    }

    public function render()
    {
        return view('livewire.otp-verify');
    }
}
