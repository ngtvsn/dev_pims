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
            $table->unsignedBigInteger('version_of_id')->nullable()->after('id');

            $table->foreign('version_of_id')
                  ->references('id')
                  ->on('issuance_documents')
                  ->onDelete('cascade');
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
            $table->dropForeign(['version_of_id']);
            $table->dropColumn('version_of_id');
        });
    }
};
