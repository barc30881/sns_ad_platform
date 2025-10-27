<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'role',
        'referral_code',
        'referred_by_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'role' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            if (!$user->referral_code) {
                $user->referral_code = strtoupper(Str::random(8));
                while (self::where('referral_code', $user->referral_code)->exists()) {
                    $user->referral_code = strtoupper(Str::random(8));
                }
            }
        });
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function adSubmissions()
    {
        return $this->hasMany(AdSubmission::class, 'freelancer_id');
    }

    public function paymentSettings()
    {
        return $this->hasOne(FreelancerPaymentSetting::class, 'freelancer_id');
    }

    public function payments()
    {
        return $this->hasMany(FreelancerPayment::class, 'freelancer_id');
    }

    public function referrals()
    {
        return $this->hasMany(Referral::class, 'referrer_id');
    }

    public function referredBy()
    {
        return $this->belongsTo(User::class, 'referred_by_id');
    }

    public function getReferralLinkAttribute()
    {
        return route('home') . '?ref=' . $this->referral_code;
    }
}
