<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Illuminate\Auth\Events\Lockout;
use Livewire\Form;
use App\Mail\OtpMail;
use Carbon\Carbon;

class LoginForm extends Form
{
    #[Validate('required|string')]
    public string $dswd_id = ''; 

    #[Validate('required|string')]
    public string $password = '';

    #[Validate('boolean')]
    public bool $remember = false;

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['dswd_id' => $this->dswd_id, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'form.dswd_id' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());

        $this->sendOtp();
    }

    /**
     * Send OTP to the user's email.
     */
    protected function sendOtp(): void
    {
        $user = Auth::user();
        $otp = rand(100000, 999999); // Generate a 6-digit OTP
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10); // OTP valid for 10 minutes
        $user->save();

        Mail::to($user->email)->send(new OtpMail($otp));
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'form.dswd_id' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->dswd_id).'|'.request()->ip());
    }
}
