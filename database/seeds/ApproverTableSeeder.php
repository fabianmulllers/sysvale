<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ApproverTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        for ($i =0;$i< 5 ; $i ++) {
                DB::table('users')->insert([
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->email,
                'password' => bcrypt('123456'),
                'type' => 'approver',

            ]);
            
        }
    }
}
