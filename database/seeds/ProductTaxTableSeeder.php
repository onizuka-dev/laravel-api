<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Tax;

class ProductTaxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products_ids = Product::all()->count();
        $taxes_ids = Tax::all()->count();

        foreach (range(1, 30) as $item) {
            DB::table('product_tax')->insert([
                'tax_id' => rand(0, $taxes_ids),
                'product_id' => rand(0, $products_ids)
            ]);
        }
    }
}
