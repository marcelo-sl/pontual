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
            [ 'field' => 'Barbeiro' ],
            [ 'field' => 'Cabeleireiro(a)' ],
            [ 'field' => 'Designer de sombrancelhas' ],
            [ 'field' => 'Manicure' ],
            [ 'field' => 'Pedicure' ],
        ]);
    }
}
