<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $defaultUserRoles = [
            ['user_id'=>1, 'role_id'=>1],
            ['user_id'=>2, 'role_id'=>2],
            ['user_id'=>3, 'role_id'=>3],
            ['user_id'=>2, 'role_id'=>3],
            ['user_id'=>1, 'role_id'=>3],
        ];

        foreach($defaultUserRoles as $userRole){
            \App\Models\UserRole::factory()->create($userRole);
        }
    }
}
