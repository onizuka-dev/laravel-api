<?php

use Illuminate\Database\Seeder;
use App\Product;

class DatabaseSeeder extends Seeder
{
    private $tables = [
        'products',
        'categories',
        'taxes',
        'product_tax'
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables();
        // $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(TaxTableSeeder::class);
        $this->call(ProductTaxTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }

    private function truncateTables ()
    {
        foreach ($this->tables as $table) {
            \DB::table($table)->truncate();
        }
    }
}
