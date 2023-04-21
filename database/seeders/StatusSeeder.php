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
        ]);
        Status::create(
        [
            'situation' => 'Bancada',
        ]);
        Status::create(
        [
            'situation' => 'Aguardando Peças',
        ]);
        Status::create(
        [
            'situation' => 'Garantia',
        ]);
        Status::create(
        [
            'situation' => 'Pendente',
        ]);
        Status::create(
        [
            'situation' => 'Concluído',
        ]);
        Status::create(
        [
            'situation' => 'Entregue',
        ]);
        Status::create(
        [
            'situation' => 'Baixa',
        ]
        );
    }
}
