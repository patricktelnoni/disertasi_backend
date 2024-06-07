<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use Illuminate\Support\Facades\DB;
use App\Models\InfoProyek;

class InfoProyekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 50; $i++){
 
            // insert data ke table pegawai menggunakan Faker
          DB::table('table_info_proyek')->insert([
              'nomor_kontrak' => $faker->numberBetween(1, 1000),
              'nama_paket' => $faker->sentence(3),
              'nama_satker' => $faker->sentence(3),
              'nama_ppk' => $faker->sentence(3),
              'nilai_kontrak' => $faker->numberBetween(1, 10000000),
              'lokasi_pekerjaan' => $faker->sentence(3),
                'masa_pelaksanaan' => $faker->sentence(3),
                'tanggal_pho' => $faker->date(),
                'tanggal_kontrak' => $faker->date(),

          ]);

      }
    }
}
