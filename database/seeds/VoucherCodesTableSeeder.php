<?php

use Illuminate\Database\Seeder;

class VoucherCodesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(\VH\Models\VoucherCode::class,35)->create();
	}
}
