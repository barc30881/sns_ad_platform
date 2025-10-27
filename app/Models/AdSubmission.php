<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Factories\HasFactory;
   use Illuminate\Database\Eloquent\Model;

   class AdSubmission extends Model
   {
       use HasFactory;

       protected $fillable = ['freelancer_id', 'ad_id', 'sns_links', 'reward', 'status', 'created_at', 'updated_at'];

       protected $casts = [
           'sns_links' => 'array',
           'reward' => 'decimal:2',
       ];

       public function freelancer()
       {
           return $this->belongsTo(User::class, 'freelancer_id');
       }

       public function ad()
       {
           return $this->belongsTo(Ad::class, 'ad_id');
       }
   }
   