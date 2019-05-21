<?php

use App\User;
use App\Property;
use App\PropertyRatePayment;
use App\PropertyImage;
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
    $amount = $type==2 ?
    $faker->numberBetween($min=50000, $max=9999999) : //sale
    $faker->numberBetween($min=70, $max=9999); //rent
    $title = $faker->numberBetween($min=1, $max=6). " Bedroom Self-Contained House";
    $areas = ["Madina", "Adenta", "Achimota", "Osu", "East Legon", "Ashaiman", "Oyarifa", "Libya Quaters"
                ,"Ashomang Estate", "North Legon", "Ridge", "Nima", "Airport", "Shiashie", "Ashalley Botwe",
                "Accra New Town", "Old Town"];
    $rand_area = array_rand($areas);
    return [
        'title' =>$title,
        'class' => $faker->numberBetween($min=1, $max=3),
        'description' => $faker->realText($maxNbChars = 100, $indexSize = 2),
        'location'=>$areas[$rand_area],
        'type' =>$type,
        'duration' =>$duration,
        'owner_id' => $owner->id,
        'amount' => $amount
    ];
});

$factory->define(PropertyImage::class, function(Faker $faker){
    return [];
});

$factory->afterCreating(Property::class, function ($property, $faker) {
    $property->images()->save(factory(App\PropertyImage::class)->make([
        'path' => "images/house".rand(1,4).".jpg",
        //'property_id' => $property->id
    ]));

    $property->images()->save(factory(App\PropertyImage::class)->make([
        'path' => "images/hall".rand(1,4).".jpg",
        //'property_id' => $property->id
    ]));

    $property->images()->save(factory(App\PropertyImage::class)->make([
        'path' => "images/porch".rand(1,4).".jpg",
        //'property_id' => $property->id
    ]));

    $property->images()->save(factory(App\PropertyImage::class)->make([
        'path' => "images/toilet".rand(1,4).".jpg",
        //'property_id' => $property->id
    ]));

    $property->images()->save(factory(App\PropertyImage::class)->make([
        'path' => "images/room".rand(1,4).".jpg",
        //'property_id' => $property->id
    ]));

    $property->images()->save(factory(App\PropertyImage::class)->make([
        'path' => "images/kitchen".rand(1,4).".jpg",
        //'property_id' => $property->id
    ]));
});

$factory->define(PropertyRatePayment::class, function(Faker $faker){
    return[
        'transaction_id' => $faker->numberBetween($min=1, $max=9999999999999),
        'amount'=> $faker->numberBetween($min=100, $max=999),
        'active_year' => Carbon\Carbon::now()->year
    ];
});
