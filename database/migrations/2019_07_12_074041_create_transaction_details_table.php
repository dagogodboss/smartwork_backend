<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('signature')->nullable();
            $table->longText('description')->nullable();
            $table->float('amount', 100, 2)->nullable();
            $table->string('type')->nullable();
            $table->string('sub_type')->nullable();
            $table->string('destination')->nullable();
            $table->string('transaction_reference')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->
            references('id')->on('users')->onDelete('cascade')->
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
        Schema::dropIfExists('transaction_details');
    }
}
