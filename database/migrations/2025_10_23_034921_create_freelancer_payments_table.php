<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreelancerPaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('freelancer_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('freelancer_id')->constrained('users')->onDelete('cascade');
            $table->string('payment_id')->unique();
            $table->decimal('amount', 10, 2);
            $table->string('method')->default('paypal');
            $table->enum('status', ['processing', 'paid', 'failed'])->default('processing');
            $table->string('evidence')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('freelancer_payments');
    }
}
