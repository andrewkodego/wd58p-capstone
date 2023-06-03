<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultRoles = [
            ['name'=>'Super Admin', 'level'=>1, 'description'=>'Has full access in the application'],
            ['name'=>'Admin', 'level'=>2, 'description'=>'Has CRUD access in the application'],
            ['name'=>'Account User', 'level'=>3, 'description'=>'Has limited access in the application'],
        ];

        foreach($defaultRoles as $role){
            \App\Models\Role::factory()->create($role);
        }
    }
}
