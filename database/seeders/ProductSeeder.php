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
            'category_id' => 1,
            'name'        => 'Sosis Bratwurst Bakar',
            'thumbnail'   => '1.png',
            'price'       => 15000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 1,
            'name'        => 'Baso Bakar',
            'thumbnail'   => '2.png',
            'price'       => 5000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 1,
            'name'        => 'Dumpling Ayam',
            'thumbnail'   => '3.png',
            'price'       => 5000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 1,
            'name'        => 'Dumpling Keju',
            'thumbnail'   => '4.png',
            'price'       => 5000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 1,
            'name'        => 'Scallop',
            'thumbnail'   => '5.png',
            'price'       => 5000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 1,
            'name'        => 'Crabstick Bakar',
            'thumbnail'   => 'Crabstick Bakar.png',
            'price'       => 5000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 1,
            'name'        => 'Telur Gulung',
            'thumbnail'   => 'Telur Gulung.png',
            'price'       => 15000,
            'desc'        => $desc,
        ]);

        Product::create([
            'category_id' => 1,
            'name'        => 'Cireng Goreng',
            'thumbnail'   => 'Cireng Goreng.png',
            'price'       => 15000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 1,
            'name'        => 'Kentang Goreng',
            'thumbnail'   => 'Kentang Goreng.png',
            'price'       => 15000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 1,
            'name'        => 'Kaki Naga Goreng',
            'thumbnail'   => 'Kaki Naga Goreng.png',
            'price'       => 15000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 1,
            'name'        => 'Sosis Gulung',
            'thumbnail'   => 'Sosis Gulung.png',
            'price'       => 17000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 1,
            'name'        => 'Otak-otak Goreng',
            'thumbnail'   => 'Otak-otak Goreng.png',
            'price'       => 15000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 2,
            'name'        => 'Ice Teh Manis Pitcher',
            'thumbnail'   => 'Ice Teh Manis Pitcher.png',
            'price'       => 15000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 2,
            'name'        => 'Ice Teh Tarik',
            'thumbnail'   => 'Ice Teh Tarik.png',
            'price'       => 10000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 2,
            'name'        => 'Ice Coklat',
            'thumbnail'   => 'Ice Coklat.png',
            'price'       => 10000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 2,
            'name'        => 'Ice Matcha',
            'thumbnail'   => 'Ice Matcha.png',
            'price'       => 10000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 2,
            'name'        => 'Hot Coffee',
            'thumbnail'   => 'Hot Coffee.png',
            'price'       => 5000,
            'desc'        => $desc,
        ]);
    }
}
