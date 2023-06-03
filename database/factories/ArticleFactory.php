<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $content = $this->faker->paragraph(10, true);
        $excerpt = substr($content, 0, 50);
        return [
            'title'=>$this->faker->sentence(4, true),
            'content'=>$content,
            'excerpt'=>$excerpt,
            'status_id'=>12,
        ];
    }
}
