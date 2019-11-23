<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $root = Category::first();
        if (!$root) {
            Category::create([
                'name' => 'Root',
                'description' => 'This is the root category, don\'t delete this one',
                'parent_id' => null,
            ]);
        }
        factory('App\Models\Category', 20)->create();
    }
}
