<?php

namespace Database\Seeders;

use App\Models\Fornecedor;

use Illuminate\Database\Seeder;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fornecedor::factory()->count(50)->create();

        // $fornecedor = new Fornecedor();

        // $fornecedor->nome = 'Fornecedor#03';
        // $fornecedor->site = 'f03.com.br';
        // $fornecedor->uf = 'CE';
        // $fornecedor->email = 'f3@mail.com';

        // $fornecedor->save();
    }
}
