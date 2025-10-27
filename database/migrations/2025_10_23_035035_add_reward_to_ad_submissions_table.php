<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRewardToAdSubmissionsTable extends Migration
{
    public function up()
    {
        Schema::table('ad_submissions', function (Blueprint $table) {
            $table->decimal('reward', 10, 2)->nullable()->after('sns_links');
        });
    }

    public function down()
    {
        Schema::table('ad_submissions', function (Blueprint $table) {
            $table->dropColumn('reward');
        });
    }
}
