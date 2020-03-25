<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->float('deposit', 100, 2)->default(0);
            $table->text('purpose')->nullable();
            $table->boolean('is_target')->nullable()->default(0);
            $table->float('target_amount', 100, 2)->nullable()->default(0);
            $table->dateTime('end_date')->nullable();
            $table->string('savings_id')->nullable();
            $table->float('earned_profit', 100, 2)->default(0);
            $table->float('current_balance', 100, 2)->default(0);
            $table->bigInteger('account_type')->unsigned(); 
            $table->float('bonus_percent', 100, 2)->default(0);
            $table->string('method')->nullable();
            $table->string('transaction_reference')->nullable();
            $table->boolean('is_recurrent')->nullable()->default(false);
            $table->bigInteger('recurrent_interval_days')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->
            references('id')->on('users')->onDelete('cascade')->
            onUpdate('cascade');
            
            $table->foreign('account_type')->
            references('id')->on('account_types')->onDelete('cascade')->
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
        Schema::dropIfExists('savings');
    }
}
