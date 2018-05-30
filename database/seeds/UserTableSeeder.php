<?php

use Illuminate\Database\Seeder;
use App\User;
use App\role;
use App\company;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager = new user();
        $manager->f_name = 'manger-ahmed';
        $manager->l_name = 'mohamed';
        $manager->email = 'admin@admin.com';
        $manager->company_id = company::all()->first()->id;
        $manager->role = 'admin';
        $manager->phone = '+0201149702173';
        $manager->password = bcrypt('456123');
        $manager->save();

    	/*$role_employee = role::where('name', 'employee')->first();
    	$role_manager = role::where('name', 'manager')->first();

    	$employee = new user();
        $employee->f_name = 'eslam';
    	$employee->l_name = 'ayman';
        $employee->email = 'employee@gmail.com';
    	$employee->company_id = 1;
    	$employee->password = bcrypt('123456');
    	$employee->save();
    	$employee->roles()->attach($role_employee);

    	$manager = new user();
        $manager->f_name = 'manger-ahmed';
    	$manager->l_name = 'mohamed';
        $manager->email = 'admin@admin.com';
    	$manager->company_id = 1;
    	$manager->password = bcrypt('456123');
    	$manager->save();
    	$manager->roles()->attach($role_manager);*/
    }
}
