<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $st = Status::create([ 'name'=>'Waiting for approval'] );
        $st = Status::create([ 'name'=>'Approved'] );
        $st = Status::create([ 'name'=>'Rejected'] );
       
        /*Format 2*/
        /*
        $st = DB::table('statuses')->insert([
            ['name'=>'Waiting for approval'],
            ['name'=>'Approved'],
            ['name'=>'Rejected']
         ]);
         */
    }
}
