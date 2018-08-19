<?php

namespace VH\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialOffer extends Model
{
	/**
	 * Parse as Carbon date
	 */
	protected $dates = ['expiration'];

	/**
	 * mass assignment
	 */
	protected $fillable = ['name', 'discount', 'expiration'];

	/**
	 * vouchers for offer
	 */
	public function vouchers()
	{
		return $this->hasMany(VoucherCode::class);
	}
}
