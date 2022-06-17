<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimatePaymentModesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimate_payment_modes', function (Blueprint $table) {
            $table->id();
            $table->integer('persion_id')->nullable();
            $table->string('quartertype')->nullable();
            $table->string('paymentmode')->nullable();
            $table->string('FistPayment')->nullable();
            $table->string('Fistpaymentmode')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('payment')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('estimate_payment_modes');
    }
}
