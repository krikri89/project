<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $faker = Faker::create('fr_FR',);


        foreach (range(1, 7) as $_) {
            DB::table('restaurants')->insert([
                'restaurant' => $faker->company(),
                'code' => rand(10000, 99999),
                'streetAddress' => $faker->streetAddress(),
                'city' => $faker->city()
            ]);
        }
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123'),
            'role' => 10,
        ]);

        $dishes = [
            'Pizza Margherita', 'Pizza Marinara', 'Pizza Frutti di Mare', 'Pizza Capricciosa', 'Pizza Prosciutto e funghi', 'Pizza Boscaiola', 'Pizza Diavola', 'Pizza Quattro Stagioni', 'Pizza Quattro Formaggi', 'Pizza Vegetariana'
        ];


        foreach (range(1, 20) as $_) {
            DB::table('dishes')->insert([
                'dish' => $dishes[rand(0, count($dishes) - 1)],
                'description' => $faker->name(),
                // 'photo' => $faker->photo()
            ]);
        }

        $menus = [
            'Children', 'Weekend', 'Super-Hungry', 'Vegetarian '
        ];
        foreach ($menus as $menu) {
            DB::table('menus')->insert([
                'menu' => $menu,
                'price' => rand(4, 12),
                'restaurant_id' => rand(1, 9)
            ]);
        }
    }
}
