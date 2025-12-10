<?php

namespace Miladev\LaravelMeta\Database\Factories;

use Miladev\LaravelMeta\Models\Meta;
use Illuminate\Database\Eloquent\Factories\Factory;

class MetaFactory extends Factory
{
	protected $model = Meta::class;

	public function definition()
	{
		return [
			'key' => $this->faker->word(),
			'value' => $this->faker->sentence(),
		];
	}
}