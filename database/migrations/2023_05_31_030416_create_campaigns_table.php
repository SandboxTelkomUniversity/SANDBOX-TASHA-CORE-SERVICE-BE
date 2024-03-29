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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_user')->nullable();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->bigInteger('target_funding_amount')->nullable();
            $table->bigInteger('current_funding_amount')->nullable();
            $table->date('start_date')->nullable();
            $table->date('closing_date')->nullable();
            $table->integer('return_investment_period')->default(1);
            $table->enum('status', ['WAITING_VERIFICATION', 'REJECTED', 'ACTIVE', 'ACHIEVED', 'PROCESSED', 'RUNNING', 'DONE'])->default('WAITING_VERIFICATION');
            $table->string('prospektus_url')->nullable();
            $table->string('category')->nullable();
            $table->boolean('is_approved')->nullable();
            $table->integer('max_sukuk')->nullable();
            $table->integer('tenors')->default(1);
            $table->float('profit_share')->nullable();
            $table->integer('sold_sukuk')->nullable();
            $table->string('created_by')->default('system');
            $table->string('updated_by')->default('system');
            $table->boolean('is_deleted')->default(false);
            $table->integer('version')->default(1);
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
};
