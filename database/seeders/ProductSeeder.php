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
        collect([
            [
                'name' => 'Sabão em Po',
                'quantity' => '2'
            ],
            [
                'name' => 'Sabão Liquido',
                'quantity' => '5'
            ],
        ])->each(function ($productStub){
            Product::updateOrCreate($productStub);
        });
    }
}
