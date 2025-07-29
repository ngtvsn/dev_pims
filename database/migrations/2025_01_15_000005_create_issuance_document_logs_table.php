<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuanceDocumentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issuance_document_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('document_id')->nullable();
            $table->integer('status_type_id')->nullable();
            $table->integer('action_id')->nullable(); // Forward / Complete
            $table->integer('from_office_id')->nullable();
            $table->integer('to_office_id')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('issuance_document_logs');
    }
}