<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groupMainMenus = [
            ['name'=>'GUEST'],
            ['name'=>'CONSOLE'],
            ['name'=>'USER'],
        ];

        foreach($groupMainMenus as $menu){
            \App\Models\Module::factory()->create($menu);
        }

        $consoleMenus = [
            ['name'=>'Dashboard', 'route'=>'dashboard', 'parent_module_id'=>2],
            ['name'=>'Manage Users', 'route'=>'users.index', 'parent_module_id'=>2],
            ['name'=>'Manage Options', 'route'=>'options.index', 'parent_module_id'=>2],
            ['name'=>'Manage Option Groups', 'route'=>'option-groups.index', 'parent_module_id'=>2],
        ];

        foreach($consoleMenus as $menu){
            \App\Models\Module::factory()->create($menu);
        }

    }
}
