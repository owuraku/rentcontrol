<?php

use Illuminate\Database\Seeder;

class PropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       // $faker = Faker::create();
        factory(App\Property::class, 15)
        ->create()
        ->each(function($property){
            $property->ratePayments()
            ->save(factory(App\PropertyRatePayment::class)
            ->make([
                'property_id' => $property->id
            ]));
        });
    }
}
