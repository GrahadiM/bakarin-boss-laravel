<?php

namespace Database\Seeders;

use App\Models\Product;
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
        $desc = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias ratione, temporibus cum laboriosam sunt eligendi.';

        Product::create([
            'name'        => 'Sosis Bratwurst Bakar',
            'thumbnail'   => '1.png',
            'price'       => 20000,
            'desc'        => $desc,
        ]);
        Product::create([
            'name'        => 'Baso Bakar',
            'thumbnail'   => '2.png',
            'price'       => 15000,
            'desc'        => $desc,
        ]);
        Product::create([
            'name'        => 'Dumpling Ayam',
            'thumbnail'   => '3.png',
            'price'       => 25000,
            'desc'        => $desc,
        ]);
        Product::create([
            'name'        => 'Dumpling Keju',
            'thumbnail'   => '4.png',
            'price'       => 15000,
            'desc'        => $desc,
        ]);
        Product::create([
            'name'        => 'Scallop',
            'thumbnail'   => '5.png',
            'price'       => 15000,
            'desc'        => $desc,
        ]);
    }
}
