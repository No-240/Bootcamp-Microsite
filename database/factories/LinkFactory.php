<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Link;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Link>
 */
class LinkFactory extends Factory
{
    protected $model = Link::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'url' => $this->faker->url(),
            'image' => null,
            'is_active' => $this->faker->boolean(80),
            'clicks' => $this->faker->numberBetween(0, 250),
        ];
    }
}
