<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
//            'user_id' => $this->faker->numberBetween(1,5),
            'title' => $this->faker->sentence(5, false),
//            'time' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'description' => $this->faker->sentence(6, true)
        ];
    }
}
