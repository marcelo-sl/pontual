<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['role_name' => 'Admin'],
            ['role_name' => 'Owner'],
            ['role_name' => 'Supervisor'],
            ['role_name' => 'Employee'],
            ['role_name' => 'Customer'],
            ['role_name' => 'Common User'],
        ]);
    }
}
