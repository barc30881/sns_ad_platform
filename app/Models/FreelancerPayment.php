<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreelancerPayment extends Model
{
    use HasFactory;

    protected $fillable = ['freelancer_id', 'payment_id', 'amount', 'method', 'status', 'evidence', 'paid_at'];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }
}