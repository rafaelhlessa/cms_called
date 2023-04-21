<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create(
        [
            'situation' => 'Aberto',
        ],
        [
            'situation' => 'Bancada',
        ],
        [
            'situation' => 'Aguardando Peças',
        ],
        [
            'situation' => 'Garantia',
        ],
        [
            'situation' => 'Pendente',
        ],
        [
            'situation' => 'Concluído',
        ],
        [
            'situation' => 'Entregue',
        ],
        [
            'situation' => 'Baixa',
        ]
        );
    }
}
