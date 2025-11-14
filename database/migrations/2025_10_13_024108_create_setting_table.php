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
        Schema::create('setting', function (Blueprint $table) {
            $table->id();
            $table->text('url');
            $table->text('PUBLIC_PEM_KEY');
            $table->text('PRIVATE_PEM_KEY');
            $table->text('ENCRYPT_KEY_ID');
            $table->text('MERCHANT_NO');
            $table->text('merchant_name');
            $table->text('callback_url');
            $table->text('submerName');
            $table->text('setting_name');
            $table->text('status');
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
        Schema::dropIfExists('setting');
    }
};
