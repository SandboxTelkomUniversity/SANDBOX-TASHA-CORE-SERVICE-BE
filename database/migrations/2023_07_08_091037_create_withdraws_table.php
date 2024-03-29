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
        Schema::create('withdraws', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_user')->nullable();
            $table->uuid('id_campaign')->nullable();
            $table->bigInteger('amount');
            $table->bigInteger('registration_fee')->default('100000');
            $table->bigInteger('service_fee')->default('10000');
            $table->enum('status', ['WAITING_VERIFICATION', 'REJECTED', 'APPROVED'])->default('WAITING_VERIFICATION');
            $table->string('created_by')->default('system');
            $table->string('updated_by')->default('system');
            $table->boolean('is_deleted')->default(false);
            $table->integer('version')->default(1);
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_campaign')->references('id')->on('campaigns');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdraws');
    }
};
