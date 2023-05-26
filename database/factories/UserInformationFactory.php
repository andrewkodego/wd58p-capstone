<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserInformation>
 */
class UserInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>0,
            'first_name'=>fake()->firstName(),
            'middle_name'=>'',
            'last_name'=>fake()->lastName(),
            'alias'=>'',
            'birthdate'=>fake()->date(),
            'primary_address'=>0,
            'secondary_address'=>0,
            'created_by'=>0,
            'modified_by'=>0,
        ];
    }
}
