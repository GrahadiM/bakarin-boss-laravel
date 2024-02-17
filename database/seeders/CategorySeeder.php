<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
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
        $data = [
            "Makanan",
            "Minuman",
        ];

        foreach ($data as $item) {
            Category::create([
                'name' => Str::ucfirst($item),
            ]);
        }
    }
}
