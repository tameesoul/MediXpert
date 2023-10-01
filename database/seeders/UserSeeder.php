<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>"ahmedtamee",
            'email'=>"ahmedtamee@123.com",
            'password'=>Hash::make('Coconut'),
            'phone_number'=>"12345678901"
        ]);

        DB::table('users')->insert([
            'name'=>"ahmedtamee",
            'email'=>"ahmedtamee@124.com",
            'password'=>Hash::make('Coconut'),
            'phone_number'=>"12345678909" 
        ]);
    }
}
