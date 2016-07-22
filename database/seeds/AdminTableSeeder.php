<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        DB::table('users')->insert([
            'name'=> 'admin',
            'last_name'=>'admin',
            'email' => 'admin@admin.cl',
            'password' => bcrypt('admin'),
            'type' => 'admin',

        ]);

    }
}
