<?php

namespace Database\Factories;

use App\Models\Advertising;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertisingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Advertising::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'channel_id' => Channel::all()->random(),
            'start_date' => $this->faker->dateTime,
            'end_date' => $this->faker->dateTime,
        ];
    }
}
