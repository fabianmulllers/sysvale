<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name'=> 'user',
            'last_name'=>'user',
            'email' => 'user@user.cl',
            'password' => bcrypt('123456'),
            'type' => 'user',

        ]);

        $faker = Faker::create();

        for ($i =0;$i< 5 ; $i ++) {
            DB::table('users')->insert([
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->email,
                'password' => bcrypt('123456'),
                'type' => 'user',

            ]);

        }
    }
}
