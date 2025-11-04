<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        // $faker = Faker::create('id_ID');

        // for($i = 0; $i < 10; $i++) {
        //     Product::create([
        //         'name' => $faker->name,
        //         'description' => $faker->text,
        //     ]);
        // }
        Product::factory()->count(100)->create();
    }
}
