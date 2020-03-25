<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Withdrawal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('savings_id');
            $table->float('initial_balance', 100, 2);
            $table->float('withdraw', 100, 2);
            $table->float('current_balance', 100, 2);
            $table->timestamps();

            $table->foreign('user_id')->
            references('id')->on('users')->onDelete('cascade')->
            onUpdate('cascade');
            
            $table->foreign('savings_id')->
            references('id')->on('savings')->onDelete('cascade')->
            onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdrawals');
    }
}
