<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrdSolicitationEmailsTable extends Migration
{
    public function up()
    {
        Schema::create(
            'ird_solicitation_emails',
            function (Blueprint $table) {
                $table->id();
                $table->integer('created_by')->default(0);
                $table->string('created_by_name', 100)->nullable();
                $table->string('request_number', 100)->nullable();
                $table->string('to_email')->nullable();
                $table->dateTime('sent_at')->nullable();
                $table->dateTime('replay_at')->nullable();
                $table->dateTime('received_at')->nullable();
                $table->integer('doc_count')->default(0);
                $table->string('email_status', 100)->default('Pending');
                $table->timestamps();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('ird_solicitation_emails');
    }
}
