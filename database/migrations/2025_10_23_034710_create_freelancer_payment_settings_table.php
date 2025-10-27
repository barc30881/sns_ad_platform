<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreelancerPaymentSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('freelancer_payment_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('freelancer_id')->constrained('users')->onDelete('cascade');
            $table->string('full_name');
            $table->string('paypal_email')->unique();
            $table->string('country')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('freelancer_payment_settings');
    }
}
