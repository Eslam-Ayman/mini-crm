<?php

use Illuminate\Database\Seeder;
use App\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = new company();
        $company->name = 'Company';
        $company->email = 'Company@company.com';
        $company->website = 'http://www.company.com';
        $company->logo_path = 'storage/logos/noImage.jpg';
        $company->save();
        
    }
}
