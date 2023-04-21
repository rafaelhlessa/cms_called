<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technic;

class TechnicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Technic::create(
            [
                'name' => 'Anderson Rateiro',
                'phone' => '(48) 90909090',
                'company' => 'Ilha Service',
            ]
        );
        Technic::create(
            [
                'name' => 'Anderson Luis',
                'phone' => '(48) 90909090',
                'company' => 'Ilha Service',
            ]
        );
        Technic::create(
            [
                'name' => 'Arthur Rodrigues',
                'phone' => '(48) 90909090',
                'company' => 'Ilha Service',
            ]
        );
        Technic::create(
            [
                'name' => 'Guilherme Isac',
                'phone' => '(48) 90909090',
                'company' => 'Ilha Service',
            ]
        );
        Technic::create(
            [
                'name' => 'Jean Ramos',
                'phone' => '(48) 90909090',
                'company' => 'Ilha Service',
            ]
        );
        Technic::create(
            [
                'name' => 'Douglas Schauffert',
                'phone' => '(48) 90909090',
                'company' => 'PMSC',
            ]
        );
    }
}
