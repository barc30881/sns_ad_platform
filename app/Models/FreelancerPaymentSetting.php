<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreelancerPaymentSetting extends Model
{
    use HasFactory;

    protected $fillable = ['freelancer_id', 'full_name', 'paypal_email', 'country', 'is_verified'];

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }
}
