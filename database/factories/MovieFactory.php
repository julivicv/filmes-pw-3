<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = ['The Shawshank Redemption', 'The Godfather', 'The Dark Knight', 'The Godfather Part II', '12 Angry Men', 'Schindler\'s List', 'The Lord of the Rings: The Return of the King', 'Pulp Fiction', 'The Lord of the Rings: The Fellowship of the Ring', 'The Good, the Bad and the Ugly', 'Forrest Gump', 'Fight Club', 'Inception'];
        $img = ['covers/a.jpg', 'covers/b.jpg', 'covers/c.jpg', 'covers/d.jpg', 'covers/e.jpg', 'covers/f.jpg', 'covers/g.jpg', 'covers/h.jpg', ];
        return [
            'name' => $this->faker->randomElement($names),
            'category_id' => $this->faker->numberBetween(1, 8),
            'year' => $this->faker->numberBetween(1888, 2024),
            'img' => $this->faker->randomElement($img),
            'name' => $this->faker->randomElement($names),
            'synopsis' => $this->faker->paragraph(),
            'link' => 'dQw4w9WgXcQ',
        ];
    }
}
