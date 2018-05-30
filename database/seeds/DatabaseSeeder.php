<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
//note you must put all of th next lines in the same order because there are some tables depends on others

        $this->call(RoleTableSeeder::class);

        $this->call(CompanyTableSeeder::class);

        $this->call(UserTableSeeder::class);

    }
}
