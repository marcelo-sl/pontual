<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'RAFAEL LEITE',
                'email' => 'rafadslt@gmail.com',
                'password' => Hash::make('rafael123!'),
                'gender' => 'M',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'MARCELO SOUSA',
                'email' => 'mar.sousa2061@gmail.com ',
                'password' => Hash::make('marcelo123!'),
                'gender' => 'M',                
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ]);
    }
}
