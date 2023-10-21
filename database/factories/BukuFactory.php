<?php

namespace Database\Factories;

use App\Models\Buku;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\book>
 */
class BukuFactory extends Factory
{
    protected $model = Buku::class;

    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(),
            'penulis' => $this->faker->name(),
            'harga' => $this->faker->numberBetween(30000,500000),
            'terbit' => $this->faker->date('Y-m-d')
        ];
    }
}
