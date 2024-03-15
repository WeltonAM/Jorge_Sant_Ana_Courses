<?php

namespace Database\Seeders;

use App\Models\SiteContato;
use Database\Factories\SiteContatoFactory;
use Illuminate\Database\Seeder;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteContato::factory()->count(50)->create();

        // $contato = new SiteContato();

        // $contato->nome = 'Sistema SG';
        // $contato->telefone = '(11) 98888-7777';
        // $contato->email = 'c@mail.com';
        // $contato->motivo_contato = 1;
        // $contato->mensagem = 'Seja bem-vindo ao sistema Super Gestão!';

        // $contato->save();
    }
}
