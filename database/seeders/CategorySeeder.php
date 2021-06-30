<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     Category::truncate();
    
     $categories = ['Running', 'Trining', 'BasketBall', 'Hiking', 'Football'];

     foreach ($categories as $index => $category) {
         Category::create([
             'name' => $category
         ]);
     }
     
    }
}
