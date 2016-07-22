<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        for ($i =0;$i< 100 ; $i ++) {
            DB::table('products')->insert([
                'name_product' => $faker->word,
                'precio_product' => $faker->numberBetween($min = 1000, $max = 20000),
                'stock_product' => $faker->numberBetween($min = 10, $max = 100)

            ]);

        }
    }
}
