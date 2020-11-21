<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('email_id', 255)->nullable();
            $table->string('mobile_num', 255)->nullable();
            $table->float('donation_amt')->default('0.00');
            $table->string('paymnt_status', 255)->nullable();
            $table->string('txn_id', 255)->nullable();
            $table->string('payment_date', 255)->nullable();
            $table->float('mc_gross')->default('0.00');
            $table->float('payment_gross')->default('0.00');
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
        Schema::dropIfExists('donations');
    }
}
