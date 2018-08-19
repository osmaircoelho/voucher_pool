<?php

namespace VH\Http\Controllers\Vpool;

use DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use VH\Http\Controllers\Controller;
use VH\Models\Recipient;
use VH\Models\VoucherCode;


class VoucherCodeController extends Controller {
	/**
	 * m_responsekeys(conn, identifier) API
	 */
	public function __construct() {
		\App::setLocale( 'en' );
	}

	/**
	 * JSON response
	 * with an email search for valid coupons
	 */
	public function list( $email ) {

		$recipient = Recipient::where( 'email', $email )->first();

		if ( $recipient ) {
			$voucherCodes = $recipient->vouchers()->join( 'special_offers', 'special_offers.id', '=',
				'voucher_codes.special_offer_id' )
			                          ->whereNull( 'voucher_codes.used_on' )
			                          ->where( 'special_offers.expiration', '>=', Carbon::today() )->get();

			//dd(DB::getQueryLog());

			$vouchers = [];

			foreach ( $voucherCodes as $voucher ) {
				$vouchers[] = [
					'offer_name' => $voucher->specialOffer->name,
					'code'       => $voucher->code,
					'discount'   => number_format( $voucher->specialOffer->discount ),
					'expiration' => $voucher->specialOffer->expiration->format( 'd-m-Y' ),
				];
			}

			return response()->json( [
				'code'     => 200,
				'message'  => 'Successful',
				'vouchers' => $vouchers
			], 200 );
		} else {
			return response()->json( [
				'code'    => 400,
				'message' => 'Invalid email address.'
			], 400 );
		}
	}


	public function use( Request $request ) {
		$vali = Validator::make( $request->all(), [
			'email'        => 'required|email',
			'voucher_code' => 'required|string|min:8'
		] );

		if ( $vali->fails() ) {
			return response()->json( [
				'code'    => 400,
				'message' => $vali->errors()->first()
			], 400 );
		}

		$email = Recipient::where( 'email', $request->input( 'email' ) )->first();

		if ( ! $email) {
			return response()->json( [
				'code'    => 400,
				'message' => 'Invalid email address.'
			], 400 );
		}

		$voucherCode = $email->vouchers()->select( [
			'voucher_codes.id',
			'special_offers.discount'
		] )->join( 'special_offers', 'special_offers.id', '=',
			'voucher_codes.special_offer_id' )->where( 'voucher_codes.code',
			$request->input( 'voucher_code' ) )->whereNull( 'voucher_codes.used_on' )->where( 'special_offers.expiration',
			'>=', Carbon::today() )->first();

		if ( !$voucherCode ) {
			return response()->json( [
				'code'    => 400,
				'message' => 'Invalid voucher code.'
			], 400 );
		}

		$data = \DB::table( 'voucher_codes' )
		   ->where( 'id', $voucherCode->id )
		   ->update( [ 'used_on' => Carbon::now() ] );

		if($data){
			return response()->json( [
				'code'     => 200,
				'message'  => 'Successful',
				'discount' => number_format( $voucherCode->discount, 2 )
			] );
		}

	}
}
