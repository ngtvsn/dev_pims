<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuanceDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issuance_documents', function (Blueprint $table) {
            $table->id();
            $table->integer('status_type_id')->nullable(); // Active / Inactive
            $table->string('document_reference_code'); // Made mandatory
            $table->integer('document_type_id'); // Made mandatory
            $table->integer('document_sub_type_id'); // Made mandatory
            $table->string('document_title'); // Made mandatory
            $table->date('document_date'); // Added new mandatory field
            $table->text('description')->nullable(); // Renamed from 'note'
            $table->text('specify_attachments')->nullable();
            $table->string('file_path')->nullable(); // Added for file storage
            $table->string('original_filename')->nullable(); // Added for original file name
            $table->integer('office_id'); // Made mandatory
            $table->integer('created_by'); // Made mandatory
            $table->integer('updated_by'); // Made mandatory
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
        Schema::dropIfExists('issuance_documents');
    }
}