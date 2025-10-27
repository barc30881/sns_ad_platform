<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdSubmissionsTable extends Migration
{
    public function up()
    {
        Schema::create('ad_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('freelancer_id');
            $table->unsignedBigInteger('ad_id');
            $table->json('sns_links'); // Array of SNS links
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('freelancer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ad_id')->references('id')->on('ads')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ad_submissions');
    }
}
