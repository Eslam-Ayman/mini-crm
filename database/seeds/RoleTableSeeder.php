<?php

use Illuminate\Database\Seeder;

use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new role();
        $role_employee->name = 'employee';
        $role_employee->description  = 'A Emplyee User';
        $role_employee->save();

        $role_manager = new role();
        $role_manager->name = 'manager';
        $role_manager->description = 'A manager user';
        $role_manager->save();
    }
}
