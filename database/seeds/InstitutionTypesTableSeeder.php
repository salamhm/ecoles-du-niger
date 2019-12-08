<?php

use App\Models\InstitutionType;
use Illuminate\Database\Seeder;

class InstitutionTypesTableSeeder extends Seeder
{
    private $institutionTypes = ['Public', 'Privé', 'Sémi public', 'Public à caractère privé'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->institutionTypes as $type) {
            InstitutionType::create([
                'name' => $type,
            ]);
        }
    }
}
