<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralBonusTable extends Migration
{
    public function up()
    {
        Schema::create('referral_bonus', function (Blueprint $table) {
            $table->id();
            $table->decimal('bonus_amount', 10, 2)->default(5.00);
            $table->timestamps();
        });
        DB::table('referral_bonus')->insert(['bonus_amount' => 5.00]);
    }

    public function down()
    {
        Schema::dropIfExists('referral_bonus');
    }
}
