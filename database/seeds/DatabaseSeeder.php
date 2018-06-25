<?php

use Illuminate\Database\Seeder;
use App\Product;

class DatabaseSeeder extends Seeder
{
    private $tables = ['products'];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate_all_tables();
        $this->call(ProductsTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }

    private function truncate_all_tables ()
    {
        foreach ($this->tables as $table) {
            \DB::table($table)->truncate();
        }
    }
}
