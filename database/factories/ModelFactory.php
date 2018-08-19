<?php
//declare(strict_types=1);
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define( \VH\Models\Recipient::class, function ( \Faker\Generator $faker ) {
	return [
		'name'       => $faker->name,
		'email'      => $faker->unique()->email
	];
} );

$factory->define( \VH\Models\SpecialOffer::class, function ( \Faker\Generator $faker ) {
	return [
		'name'       => $faker->sentence( 3 ),
		'discount'   => $faker->numberBetween( 1, 20 ),
		//dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null) // DateTime('2003-03-15 02:00:49', 'Africa/Lagos')
		'expiration' => $faker->dateTimeBetween( '-1 months', '+4 months' )
	];
} );

$factory->define( \VH\Models\VoucherCode::class, function ( \Faker\Generator $faker ) {
	return [
		'special_offer_id' => factory( 'VH\Models\SpecialOffer' )->create()->id,
		'recipient_id'     => factory( 'VH\Models\Recipient' )->create()->id,
		'code'             => str_random( 8 ),
		'used_on'          => rand(1,10) % 2 == 0 ? NULL : $faker->dateTimeBetween( '-5 months', 'now' )

	];
} );