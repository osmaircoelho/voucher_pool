<?php

namespace VH\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class VoucherCode extends Model implements TableInterface
{

	protected $dates = ['used_on'];
	protected $fillable = ['special_offer_id', 'recipient_id', 'code'];

	/**
	 * Create new voucher codes for offer and given recipients
	 * Return number of created vouchers
	 *
	 * @param SpecialOffer $specialOffer
	 * @param $recipients
	 *
	 * @return int
	 */
	public static function createBatch(SpecialOffer $specialOffer, $recipients)
	{
		$count = 0;
		foreach($recipients as $recipient) {

			if ('VH\Models\Recipient' === get_class($recipient)) {
				$voucherCode = new VoucherCode([
					'special_offer_id'  => $specialOffer->id,
					'recipient_id'      => $recipient->id,
					'code'              => substr(md5(rand()), 0, 8),
				]);
				$voucherCode->save();

				$count++;

				/**
				 * Code to send E-mail with voucher here
				 * Can also create a queue for improved mailing delivery
				 */
			}
		}

		return $count;
	}

	public function specialOffer() {
		return $this->belongsTo(SpecialOffer::class);
	}

	public function recipient() {
		return $this->belongsTo(Recipient::class);
	}

	/**
	 * A list of headers to be used when a table is displayed
	 *
	 * @return array
	 */
	public function getTableHeaders() {
		return [
			'',
			'Code',
			'Used',
			'Receiver',
			'Used Date'
		];
	}

	/**
	 * Get the value for a given header. Note that this will be the value
	 * passed to any callback functions that are being used.
	 *
	 * @param string $header
	 *
	 * @return mixed
	 */
	public function getValueForHeader( $header ) {
		switch ($header) {
			case '':
				return ' ';
			case 'Code':
				return $this->code;
			case 'Used':
				return $this->used_on;
			case 'Receiver':
				return $this->email;
			case 'Used Date':
				return $this->used_on; //Carbon

		}

}}
