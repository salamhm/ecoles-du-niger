<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(LevelsTableSeeder::class);
        $this->call(InstitutionTypesTableSeeder::class);
        $this->call(InstitutionsTableSeeder::class);
        $this->call(ProgramTypesTableSeeder::class);
    }
}
