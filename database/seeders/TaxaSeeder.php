<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Taxa;

class TaxaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Taxa::create(['nome' => 'Taxa de Serviço', 'total' => 100.00]);
        Taxa::create(['nome' => 'Taxa Administrativa', 'total' => 50.00]);
    }
}
