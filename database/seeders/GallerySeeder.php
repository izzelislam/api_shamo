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
                'products_id' => $faker->randomElement($product_id),
                'url'        => $faker->randomElement([
                    'https://trello-attachments.s3.amazonaws.com/604d5c3578738c5f11e77a7d/60dc259f1fcb09809e0a90f8/ad7c9724657aec61ac908dfca79c0040/s-10.jpeg',
                    'https://trello-attachments.s3.amazonaws.com/604d5c3578738c5f11e77a7d/60dc259f1fcb09809e0a90f8/f7ba17a664e9e8c079fd172e9d9dbffd/s-9.jpeg',
                    'https://trello-attachments.s3.amazonaws.com/604d5c3578738c5f11e77a7d/60dc259f1fcb09809e0a90f8/f751fa86be7c5958aeeeeec9b7d3ecc1/s-8.jpeg',
                    'https://trello-attachments.s3.amazonaws.com/604d5c3578738c5f11e77a7d/60dc259f1fcb09809e0a90f8/94c5aeee5c407560ad09a4d6c1d2ba53/s-7.jpeg',
                    'https://trello-attachments.s3.amazonaws.com/604d5c3578738c5f11e77a7d/60dc259f1fcb09809e0a90f8/89e256a38cbb902727c81e5b8935e230/s-6.jpeg',
                    'https://trello-attachments.s3.amazonaws.com/604d5c3578738c5f11e77a7d/60dc259f1fcb09809e0a90f8/3eb396572254d2d2b956907dcb53b74e/s-5.jpeg',
                    'https://trello-attachments.s3.amazonaws.com/604d5c3578738c5f11e77a7d/60dc259f1fcb09809e0a90f8/e692077414823d8a496f1f82f1e6b17d/s-4.jpeg',
                    'https://trello-attachments.s3.amazonaws.com/604d5c3578738c5f11e77a7d/60dc259f1fcb09809e0a90f8/e46cb93c3ee5f41d16898d62fa492221/s-3.jpeg',
                    'https://trello-attachments.s3.amazonaws.com/604d5c3578738c5f11e77a7d/60dc259f1fcb09809e0a90f8/e87fafc22e056c46d0673ecd6ca7ce1f/s-2.jpeg',
                    'https://trello-attachments.s3.amazonaws.com/604d5c3578738c5f11e77a7d/60dc259f1fcb09809e0a90f8/059c861ce45ab483dc5394d7587fdf63/s-1.jpeg',
                ])
            ]);
        }
    }
}
