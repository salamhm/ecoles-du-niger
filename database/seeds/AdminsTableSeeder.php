<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::first();
        if(!$admin) {
            Admin::create([
                'name' => 'Salam',
                'email' => 'a@a.aa',
                'password' => bcrypt('aaaaaaaa'),
            ]);
        }
    }
}
