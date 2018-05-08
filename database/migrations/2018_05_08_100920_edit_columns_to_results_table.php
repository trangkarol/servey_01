<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditColumnsToResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('results', function (Blueprint $table) {
            $table->unsignedBigInteger('answer_id')->nullable()->change();
            $table->longText('content')->nullable()->change();
            $table->unsignedInteger('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('results', function (Blueprint $table) {
            $table->unsignedBigInteger('answer_id')->change();
            $table->longText('content')->change();
            $table->unsignedInteger('user_id')->change();
        });
    }
}
