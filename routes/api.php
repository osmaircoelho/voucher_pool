<?php

use Illuminate\Http\Request;

Route::post('/voucher/', 'Vpool\VoucherCodeController@use');

Route::get( '/vouchers/{email}', 'Vpool\VoucherCodeController@list' )->where( 'email',
	"[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}" );
