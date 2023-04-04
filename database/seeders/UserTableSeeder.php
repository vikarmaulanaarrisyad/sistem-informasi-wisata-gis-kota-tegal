<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory(2)->create();
        
        $admin = User::first();
        $admin->name = 'Administrator';
        $admin->email = 'admin@gmail.com';
        $admin->password = Hash::make('123456');
        $admin->role_id = 1;
        $admin->save();
    }
}
