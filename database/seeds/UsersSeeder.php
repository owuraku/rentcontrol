<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
            $faker = Faker::create();

            factory(App\User::class, 5)->create([
            'phone' => $faker->phoneNumber(),
            'password' => bcrypt('secretpass'),
            ]);

            factory(App\User::class)->create([
                'name' => 'Hannah Arthur',
                'email'=>'hannah@yahoo.com',
                'phone' => $faker->phoneNumber(),
                'password' => bcrypt('secretpass'),
        ]);
    }
}
