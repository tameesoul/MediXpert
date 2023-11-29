<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
   
    public function run(): void
    {
        // User::create([
        //     "name"=>"ahmed tamer",
        //     "email"=> "ahmed@std.com",
        //     "password"=> Hash::make('hello,world'),
        //     "phone_number"=>"01102931276"
        // ]); // this way using user model , ا //نا تعاملت مع موديل مش الجدول خلي بالك
        // // if you wanna deal with the table use querybulider using BD facade
        // DB::table('users')->insert([
        //     "name"=>"ahmed_tamee",
        //     "email"=> "ahmed123@std.com",
        //     "password"=> Hash::make('hello,world2'),
        //     "phone_number"=>"01102931276"
        // ]);
    }

}
