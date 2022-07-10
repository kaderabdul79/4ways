<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // insert data in product table
        $products = [
            ['name'=>'samsung22','description'=>'best mobile in 2022','price'=>104,'quantity'=>5],
            ['name'=>'Walton Pridge WS','description'=>'','price'=>200,'quantity'=>1],
        ];

        Product::insert($products);
    }
}
