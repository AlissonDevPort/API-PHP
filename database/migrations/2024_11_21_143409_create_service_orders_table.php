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
    Schema::create('service_orders', function (Blueprint $table) {
        $table->id();
        $table->string('vehiclePlate', 7);
        $table->dateTime('entryDateTime');
        $table->dateTime('exitDateTime')->default('0001-01-01 00:00:00');
        $table->string('priceType', 55)->nullable();
        $table->decimal('price', 12, 2)->default(0.00);
        $table->foreignId('userId')->constrained('users');
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
        Schema::dropIfExists('service_orders');
    }
};
