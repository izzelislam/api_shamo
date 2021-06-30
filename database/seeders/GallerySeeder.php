<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gallery::truncate();
        $faker      = Factory::create();
        $product_id = Product::all()->pluck('id'); 

        for ($i=0; $i < 200 ; $i++) { 
            Gallery::create([
                'url'        => $faker->randomElement([
                    's-1.jpeg',
                    's-2.jpeg',
                    's-3.jpeg',
                    's-4.jpeg',
                    's-5.jpeg',
                    's-6.jpeg',
                    's-7.jpeg',
                    's-8.jpeg',
                    's-9.jpeg',
                    's-10.jpeg',
                ])
            ]);
        }
    }
}
