<?php

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    private $levels = [
        'CAP', 'BEP', 'BAC Pro', 'BTS', 'DTS', 'License', 'Master', 'Ingéniorat', 'Doctorat'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->levels as $level)
        {
            Level::create([
                'name' => $level,
            ]);
        }
    }
}
