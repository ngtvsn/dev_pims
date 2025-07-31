<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('issuance_documents', function (Blueprint $table) {
            // Rename soft delete columns to follow issuance_ prefix convention
            $table->renameColumn('deleted_at', 'issuance_deleted_at');
            $table->renameColumn('deleted_by', 'issuance_deleted_by');
            $table->renameColumn('deletion_reason', 'issuance_deletion_reason');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('issuance_documents', function (Blueprint $table) {
            // Revert column names back to original
            $table->renameColumn('issuance_deleted_at', 'deleted_at');
            $table->renameColumn('issuance_deleted_by', 'deleted_by');
            $table->renameColumn('issuance_deletion_reason', 'deletion_reason');
        });
    }
};