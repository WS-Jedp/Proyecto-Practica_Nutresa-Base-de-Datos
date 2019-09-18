<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
           DB::table('users')->insert([
               "name" => "juanes",
               "email" => "juanes@gmail.com",
               "username"=> "jedp",
               "password" => bcrypt('secret')
           ]);

        //   DB::table('descuento_producto')->insert([
        //       'valor' => '0'
        //   ]);
    }
}
