<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surveys', function (Blueprint $table) {
            $table->tinyInteger('status');
            $table->timestamp('deadline')->nullable();
            $table->longText('description')->nullable();
            $table->string('mail')->nullable();
            $table->integer('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surveys', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('deadline');
            $table->dropColumn('description');
            $table->dropColumn('mail');
            $table->integer('user_id')->change();
        });
    }
}
