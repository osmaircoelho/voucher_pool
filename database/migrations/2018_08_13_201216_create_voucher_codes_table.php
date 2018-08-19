<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('voucher_codes', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('special_offer_id')->unsigned();
		    $table->foreign('special_offer_id')->references('id')->on('special_offers');
		    $table->integer('recipient_id')->unsigned();
		    $table->foreign('recipient_id')->references('id')->on('recipients');
		    $table->char('code',8);
		    $table->timestamp('used_on')->nullable();
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
        Schema::dropIfExists('voucher_codes');
    }
}
