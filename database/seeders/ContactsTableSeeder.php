<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * created: 2024-11-09 Ricardo Omar Lugo Vargas
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 500) as $index) {
            DB::table('contacts')->insert([
                'name' => $faker->name,
                'note' => $faker->optional()->text(200),
                'birthday' => $faker->dateTimeBetween('1980-01-01', '2003-12-31')->format('Y-m-d'),
                'page' => $faker->optional()->url(),
                'work' => $faker->optional()->company(),
                'created_at' => $faker->dateTimeBetween('2023-01-01', '2024-10-31')->format('Y-m-d')
            ]);
        }
    }
}
