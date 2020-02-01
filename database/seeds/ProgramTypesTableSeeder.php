<?php

use App\Models\ProgramType;
use Illuminate\Database\Seeder;

class ProgramTypesTableSeeder extends Seeder
{
    private $programTypes = ['Cours du jour', 'Cour du soir', 'Cours du joir et soir', 'Cours de jour ou du soir'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->programTypes as $type) {
            ProgramType::create([
                'name' => $type,
            ]);
        }
    }
}
