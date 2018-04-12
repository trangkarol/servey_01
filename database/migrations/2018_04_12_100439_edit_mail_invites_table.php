<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditMailInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invites', function (Blueprint $table) {
            $table->renameColumn('invite_mail', 'invite_mails');
            $table->renameColumn('answer_mail', 'answer_mails');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invites', function (Blueprint $table) {
            $table->renameColumn('answer_mails', 'answer_mail');
            $table->renameColumn('invite_mails', 'invite_mail');
        });
    }
}
