<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PhonesTableSeeder extends Seeder
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
                    DB::table('phones')->insert([
                        'id_contact' => $contactId,
                        'phone' => $this->generatePhoneNumber(),
                    ]);
                }
            }
            
        }
    }

    /**
     * Generate random phone number
     * created: ricardo omar lugo vargas
     * @return int
     */
    private function generatePhoneNumber()
    {
        return random_int(7000000000, 9999999999);
    }
}
