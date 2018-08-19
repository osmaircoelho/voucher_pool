<?php

use Illuminate\Database\Seeder;

class RecipientesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory( \VH\Models\Recipient::class )->create( [
			'name'  => 'Osmair Coelho',
			'email' => 'osmair.coelho@gmail.com'
		] );

		factory(\VH\Models\Recipient::class,40)->create();
	}
}
