<?php

use Illuminate\Database\Seeder;

class SpecialOffersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(\VH\Models\SpecialOffer::class,10)->create();
	}
}
