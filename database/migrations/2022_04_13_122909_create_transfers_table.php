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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->date('registered_at');
            $table->foreignId('registrant_at')->constrained('users');
            $table->foreignId('preferred_vehicle_id')->constrained('vehicles');
            $table->foreignId('preferred_driver_id')->constrained('users');
            $table->date('started_at')->nullable();
            $table->date('completed_at')->nullable();
            $table->string('status');

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
        Schema::dropIfExists('transfers');
    }
};
