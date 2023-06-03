<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleRightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultModuleRights = [
            ['role_id'=>1, 'module_id'=>4,'can_view_all'=>1,'can_view_own'=>1,'can_add'=>1,'can_edit_all'=>1,'can_edit_own'=>1,'can_delete_all'=>1,'can_delete_own'=>1,'can_export'=>1],
            ['role_id'=>1, 'module_id'=>5,'can_view_all'=>1,'can_view_own'=>1,'can_add'=>1,'can_edit_all'=>1,'can_edit_own'=>1,'can_delete_all'=>1,'can_delete_own'=>1,'can_export'=>1],
            ['role_id'=>1, 'module_id'=>6,'can_view_all'=>1,'can_view_own'=>1,'can_add'=>1,'can_edit_all'=>1,'can_edit_own'=>1,'can_delete_all'=>1,'can_delete_own'=>1,'can_export'=>1],
            ['role_id'=>1, 'module_id'=>7,'can_view_all'=>1,'can_view_own'=>1,'can_add'=>1,'can_edit_all'=>1,'can_edit_own'=>1,'can_delete_all'=>1,'can_delete_own'=>1,'can_export'=>1],
            ['role_id'=>1, 'module_id'=>8,'can_view_all'=>1,'can_view_own'=>1,'can_add'=>1,'can_edit_all'=>1,'can_edit_own'=>1,'can_delete_all'=>1,'can_delete_own'=>1,'can_export'=>1],

            ['role_id'=>2, 'module_id'=>4,'can_view_all'=>1,'can_view_own'=>1,'can_add'=>1,'can_edit_all'=>1,'can_edit_own'=>1,'can_delete_all'=>0,'can_delete_own'=>1,'can_export'=>1],
            ['role_id'=>2, 'module_id'=>5,'can_view_all'=>1,'can_view_own'=>1,'can_add'=>1,'can_edit_all'=>1,'can_edit_own'=>1,'can_delete_all'=>0,'can_delete_own'=>1,'can_export'=>1],
            ['role_id'=>2, 'module_id'=>6,'can_view_all'=>1,'can_view_own'=>1,'can_add'=>1,'can_edit_all'=>1,'can_edit_own'=>1,'can_delete_all'=>0,'can_delete_own'=>1,'can_export'=>1],
            ['role_id'=>2, 'module_id'=>7,'can_view_all'=>1,'can_view_own'=>1,'can_add'=>1,'can_edit_all'=>1,'can_edit_own'=>1,'can_delete_all'=>0,'can_delete_own'=>1,'can_export'=>1],
            ['role_id'=>2, 'module_id'=>8,'can_view_all'=>1,'can_view_own'=>1,'can_add'=>1,'can_edit_all'=>1,'can_edit_own'=>1,'can_delete_all'=>0,'can_delete_own'=>1,'can_export'=>1],

            ['role_id'=>3, 'module_id'=>4,'can_view_all'=>0,'can_view_own'=>1,'can_add'=>1,'can_edit_all'=>0,'can_edit_own'=>1,'can_delete_all'=>0,'can_delete_own'=>1,'can_export'=>0],
            ['role_id'=>3, 'module_id'=>5,'can_view_all'=>0,'can_view_own'=>1,'can_add'=>1,'can_edit_all'=>0,'can_edit_own'=>1,'can_delete_all'=>0,'can_delete_own'=>1,'can_export'=>0],
            ['role_id'=>3, 'module_id'=>6,'can_view_all'=>0,'can_view_own'=>0,'can_add'=>0,'can_edit_all'=>0,'can_edit_own'=>0,'can_delete_all'=>0,'can_delete_own'=>0,'can_export'=>0],
            ['role_id'=>3, 'module_id'=>7,'can_view_all'=>0,'can_view_own'=>0,'can_add'=>0,'can_edit_all'=>0,'can_edit_own'=>0,'can_delete_all'=>0,'can_delete_own'=>0,'can_export'=>0],
            ['role_id'=>3, 'module_id'=>8,'can_view_all'=>1,'can_view_own'=>1,'can_add'=>1,'can_edit_all'=>0,'can_edit_own'=>1,'can_delete_all'=>0,'can_delete_own'=>1,'can_export'=>0],
        ];

        foreach($defaultModuleRights as $moduleRight){
            \App\Models\ModuleRight::factory()->create($moduleRight);
        }
    }
}
