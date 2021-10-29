<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class LetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i=1; $i < 40000 ; $i++) { 
            \DB::table('letters')->insert([
                'taxpayer_id' => 3,
                'no_sp2dk' => "SP2DK-" . $faker->unique()->numberBetween(50001, 80001) . "WPJ.25/KP.25/" . $faker->numberBetween(2015, 2021),
                'tanggal_sp2dk' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'tahun' => $faker->numberBetween(2015, 2021),
                'potensi_awal' => $faker->numberBetween(100000, 500000),
                'tanggal_kirim_suki' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'tanggal_kirim_pos' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'tanggal_kempos' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ]);
        }
    }
}
