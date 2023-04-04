<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'user'
        ];

        collect($roles)->map(function ($name) {
            Role::query()
                ->updateOrCreate(compact('name'), compact('name'));
        });
    }
}
