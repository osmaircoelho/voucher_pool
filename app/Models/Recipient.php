<?php

namespace VH\Models;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
	public function vouchers()
	{
		return $this->hasMany(VoucherCode::class);
	}
}
