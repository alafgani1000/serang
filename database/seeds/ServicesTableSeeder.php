<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ser = Service::create([ 'name'=>'Email']);
        $ser = Service::create([ 'name'=>'SAP']);
        $ser = Service::create([ 'name'=>'WEB']);
        $ser = Service::create([ 'name'=>'MES']);
    }
}
