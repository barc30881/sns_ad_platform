<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateReferralCodes extends Command
{
    protected $signature = 'users:generate-referral-codes';
    protected $description = 'Generate referral codes for users without one';

    public function handle()
    {
        // Target only freelancers without a referral code
        $users = User::where('role', 'freelancer')
            ->where(function ($query) {
                $query->whereNull('referral_code')->orWhere('referral_code', '');
            })
            ->get();

        if ($users->isEmpty()) {
            $this->info('No freelancers need referral codes.');
            return;
        }

        foreach ($users as $user) {
            $referralCode = strtoupper(Str::random(8));
            while (User::where('referral_code', $referralCode)->exists()) {
                $referralCode = strtoupper(Str::random(8));
            }
            $user->update(['referral_code' => $referralCode]);
            $this->info("Generated referral code for user {$user->email}: {$referralCode}");
        }

        $this->info('Referral code generation completed.');
    }
}