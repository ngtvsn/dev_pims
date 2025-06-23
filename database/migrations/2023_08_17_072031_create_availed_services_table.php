<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('availed_services', function (Blueprint $table) {
            $table->id();
            $table->integer('status_type_id')->nullable();
            $table->integer('service_type_id')->nullable();
            $table->integer('service_category_id')->nullable();
            $table->integer('cost_field_status_id')->nullable();
            $table->text('availed_service_name')->nullable();
            $table->text('availed_service_name_short')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('availed_services');
    }
};
