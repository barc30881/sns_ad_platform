<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Associate with user
            $table->string('title'); // Ad title
            $table->text('description'); // Ad description
            $table->string('type'); // prepaid or postpaid
            $table->json('media')->nullable(); // Array of media paths
            $table->string('store_name'); // Store name
            $table->text('store_description'); // Store description
            $table->integer('quantity'); // Payment quantity
            $table->decimal('total', 8, 2); // Payment total
            $table->string('payment_method'); // creditCard or paypal
            $table->string('transaction_id')->nullable(); // Stripe or PayPal transaction ID
            $table->string('status')->default('pending'); // pending, paid, failed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
};
