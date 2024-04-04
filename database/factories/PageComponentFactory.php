<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PageComponent>
 */
class PageComponentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'page_id' => 1,
            'type' => $this->faker->randomElement(['textarea', 'image', 'header']),
            'position' => $this->faker->unique()->numberBetween(1, 100),
            'settings' => json_encode(['editable' => $this->faker->boolean]),
            'content' => $this->faker->randomElement(['Text obsah', 'url/to/your/image.png', 'Nadpis stránky']),
        ];
    }
}
