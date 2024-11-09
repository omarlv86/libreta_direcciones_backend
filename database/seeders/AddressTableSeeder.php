<?php

namespace Database\Seeders;

use App\Models\Contact;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $contactIds = Contact::pluck('id')->toArray();

        foreach ($contactIds as $contactId) {
            $isInsert = rand(0, 1);

            if ($isInsert === 1) {
                $quatityOfPhones = rand(1, 3);

                for ($i = 0; $i < $quatityOfPhones; $i++) {
                    DB::table('address')->insert([
                        'id_contact' => $contactId,
                        'street' => $faker->streetAddress,
                        'city' => $faker->city,
                        'state' => $faker->state,
                        'postal_code' => $faker->postcode,
                        'country' => $faker->country,
                    ]);
                }
            }
            
        }
    }
}
