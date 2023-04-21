<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipament;

class EquipamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Equipament::create(
        [
            'description' => 'Microcomputador'
        ]);
        Equipament::create(
        [
            'description' => 'Notebook'
        ]
        );
    }
}
