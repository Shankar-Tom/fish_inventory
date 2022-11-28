<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Admin::create([
            'name'=>'admin',
            'email'=>'admin@srmfish.com',
            'mobile_number'=>'000000',
            'password'=>\Hash::make('password@123'),
        ]);
    }
}
