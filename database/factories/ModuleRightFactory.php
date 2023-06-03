<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ModuleRight>
 */
class ModuleRightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'role_id'=>0,
            'module_id'=>0,
            'can_view_all'=>0,
            'can_view_own'=>0,
            'can_add'=>0,
            'can_edit_all'=>0,
            'can_edit_own'=>0,
            'can_delete_all'=>0,
            'can_delete_own'=>0,
            'can_export'=>0
        ];
    }
}
