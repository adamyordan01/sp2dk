<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class TaxpayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i=1; $i < 1000 ; $i++) { 
            \DB::table('taxpayers')->insert([
                'npwp' => $faker->numberBetween(2021110300000000, 2021110400000000),
                'nama' => $faker->name,
                'user_id' => 6,
                'kasi_id' => 4,
                'pelaksana_id' => 13,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')

            ]);
        }
    }
}
