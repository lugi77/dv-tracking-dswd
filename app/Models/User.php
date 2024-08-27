<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\OtpMail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'dswd_id',
        'section',
        'is_approved',
        'password',
        'otp',
        'otp_expires_at',
        'otp_verified'
        
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expires_at' => 'datetime',
        
    ];

    public function generateOtp()
    {
        $otp = Str::random(6); // Generate a 6-digit OTP
        $this->otp = $otp;
        $this->otp_expires_at = Carbon::now()->addMinutes(2); // Set expiration time to 2 minutes
        $this->save();

        // Send OTP via email
        Mail::to($this->email)->send(new OtpMail($otp));
    }

}