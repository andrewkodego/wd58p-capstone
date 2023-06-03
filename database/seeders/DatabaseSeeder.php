<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $defaultUsers = [
            ['name'=>'Super Admin', 'email'=>'superadmin@example.com'],
            ['name'=>'Account Admin', 'email'=>'admin@example.com'],
            ['name'=>'Demo User', 'email'=>'demouser@example.com'],
        ];

        foreach($defaultUsers as $user){
            \App\Models\User::factory()->create($user);
        }

        \App\Models\User::factory(100)->create();

        $this->call([
            UserInformationSeeder::class,
            OptionGroupSeeder::class,
            ModuleSeeder::class,
            RoleSeeder::class,
            UserRoleSeeder::class,
            ModuleRightSeeder::class,
        ]);
    }
}
