<?php

use App\User;
use App\Property;
use App\PropertyRatePayment;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber(),
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Property::class, function(Faker $faker){
    $type =$faker->numberBetween($min=1, $max=2);
    $owner = User::findOrFail(rand(1,5));
    $duration = $type==2 ? 0 : $faker->numberBetween($min=1, $max=36);
    $amount = $type==1 ?
    $faker->numberBetween($min=50000, $max=9999999) : //sale
    $faker->numberBetween($min=70, $max=9999); //rent
    return [
        'title' => $faker->title(),
        'class' => $faker->numberBetween($min=1, $max=3),
        'description' => $faker->realText($maxNbChars = 100, $indexSize = 2),
        'location'=>$faker->state(),
        'type' =>$type,
        'duration' =>$duration,
        'owner_id' => $owner->id,
        'amount' => $faker->numberBetween($min=500, $max=3)
    ];
});

$factory->define(PropertyRatePayment::class, function(Faker $faker){
    return[
        'transaction_id' => $faker->numberBetween($min=1, $max=9999999999999),
        'amount'=> $faker->numberBetween($min=100, $max=999),
        'active_year' => Carbon\Carbon::now()->year
    ];
});
