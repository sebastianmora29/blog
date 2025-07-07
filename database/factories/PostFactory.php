<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'titulo' => $this->faker->sentence,
        'slug' => $this->faker->unique()->slug,
        'extracto' => $this->faker->text(200),
        'contenido' => $this->faker->text(3000),
        'user_id' => User::inRandomOrder()->first()->id ?? User::factory(), // crea usuario si no hay
        'categoria_id' => Categoria::inRandomOrder()->first()->id ?? Categoria::factory(), // crea categoría si no hay
        'publicado' => true,
        'publicado_en' => now()
    ];

    }
}
