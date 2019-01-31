<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Stage;

class StagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stg = Stage::create([ 'name'=>'Waiting for boss approval']);
        $stg = Stage::create([ 'name'=>'Waiting for operation approval']);
        $stg = Stage::create([ 'name'=>'waiting for service desk']);
        $stg = Stage::create([ 'name'=>'tiket created']);
        $stg = Stage::create([ 'name'=>'resolved']);
    }
}
