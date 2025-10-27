<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralBonusesTable extends Migration
{
    public function up()
    {
        Schema::create('referral_bonuses', function (Blueprint $table) {
            $table->id();
            $table->decimal('bonus_amount', 8, 2)->default(5.00);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('referral_bonuses');
    }
}