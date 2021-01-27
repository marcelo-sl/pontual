<?php

use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            ['id' => 11, 'uf' => 'RO', 'state' => 'Rondônia'],
            ['id' => 12, 'uf' => 'AC', 'state' => 'Acre'],
            ['id' => 13, 'uf' => 'AM', 'state' => 'Amazonas'],
            ['id' => 14, 'uf' => 'RR', 'state' => 'Roraima'],
            ['id' => 15, 'uf' => 'PA', 'state' => 'Pará'],
            ['id' => 16, 'uf' => 'AP', 'state' => 'Amapá'],
            ['id' => 17, 'uf' => 'TO', 'state' => 'Tocantins'],
            ['id' => 21, 'uf' => 'MA', 'state' => 'Maranhão'],
            ['id' => 22, 'uf' => 'PI', 'state' => 'Piauí'],
            ['id' => 23, 'uf' => 'CE', 'state' => 'Ceará'],
            ['id' => 24, 'uf' => 'RN', 'state' => 'Rio Grande do Norte'],
            ['id' => 25, 'uf' => 'PB', 'state' => 'Paraíba'],
            ['id' => 26, 'uf' => 'PE', 'state' => 'Pernambuco'],
            ['id' => 27, 'uf' => 'AL', 'state' => 'Alagoas'],
            ['id' => 28, 'uf' => 'SE', 'state' => 'Sergipe'],
            ['id' => 29, 'uf' => 'BA', 'state' => 'Bahia'],
            ['id' => 31, 'uf' => 'MG', 'state' => 'Minas Gerais'],
            ['id' => 32, 'uf' => 'ES', 'state' => 'Espírito Santo'],
            ['id' => 33, 'uf' => 'RJ', 'state' => 'Rio de Janeiro'],
            ['id' => 35, 'uf' => 'SP', 'state' => 'São Paulo'],
            ['id' => 41, 'uf' => 'PR', 'state' => 'Paraná'],
            ['id' => 42, 'uf' => 'SC', 'state' => 'Santa Catarina'],
            ['id' => 43, 'uf' => 'RS', 'state' => 'Rio Grande do Sul'],
            ['id' => 50, 'uf' => 'MS', 'state' => 'Mato Grosso do Sul'],
            ['id' => 51, 'uf' => 'MT', 'state' => 'Mato Grosso'],
            ['id' => 52, 'uf' => 'GO', 'state' => 'Goiás'],
            ['id' => 53, 'uf' => 'DF', 'state' => 'Distrito Federal'],
          ]);
    }
}
