<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'type',
        'media',
        'store_name',
        'store_description',
        'quantity',
        'total',
        'payment_method',
        'transaction_id',
        'status',
        'posted_status',
    ];

    protected $casts = [
        'media' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}