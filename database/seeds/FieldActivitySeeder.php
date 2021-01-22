<?php

use Illuminate\Database\Seeder;

class FieldActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fields_activity')->insert([
            [ 'field' => 'Barbearia' ],
            [ 'field' => 'Cabeleireiro' ],
            [ 'field' => 'Salão de beleza' ],
            [ 'field' => 'Design de sombrancelhas' ],
            [ 'field' => 'Manicure' ],
            [ 'field' => 'Pedicure' ],
        ]);
    }
}
