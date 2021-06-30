<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        $faker= Factory::create();

        for ($i=0; $i < 50; $i++) { 
            Product::create([
                'categories_id' =>  $faker->randomElement([1, 2, 3, 4, 5]),
                'name'          =>  $faker->company(),
                'price'         =>  rand(1.00000, 5.000000),
                'description'   =>  $faker->paragraph(3, true),
                'tags'          =>  $faker->word(rand(1,5), false)
            ]);
        }

    }
}
