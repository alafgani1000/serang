<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user = User::create(['name'=>'helpdesk', 'email'=>'help@karyawan.com','password'=>Hash::make('helpdesk')]);
        $user = User::create(['name'=>'karyawan', 'email'=>'kary@karyawan.com','password'=>Hash::make('karyawan')]);
        $user = User::create(['name'=>'bos', 'email'=>'bos@karyawan.com','password'=>Hash::make('bos')]);
        $user = User::create(['name'=>'SP', 'email'=>'Service Desk	sp@karyawan.com','password'=>Hash::make('sp')]);
        $user = User::create(['name'=>'SPT ICT', 'email'=>'sptict@karyawan.com','password'=>Hash::make('sptict')]);
        $user = User::create(['name'=>' SO', 'email'=>'so@karyawan.com','password'=>Hash::make('so')]);

    }
}
