<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * created: ricardo omar lugo vargas
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $contactIds = DB::table('contacts')->pluck('id')->toArray();

        foreach ($contactIds as $contactId) {
            $isInsert = rand(0, 1);

            if ($isInsert === 1) {
                $quatityOfPhones = rand(1, 3);

                for ($i = 0; $i < $quatityOfPhones; $i++) {
                    DB::table('mails')->insert([
                        'contact_id' => $contactId,
                        'email' => $faker->unique()->safeEmail(),
                    ]);
                }
            }
            
        }
    }
}
