<?php

namespace Database\Factories;

use App\Models\Channel;
use App\Models\TelegramUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TelegramUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TelegramUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = ['вошел', 'вышел'];
        return [
            //
            'user_id' => $this->faker->text(200),
            'status' => $status[rand(0,1)],
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'avatar' => $this->faker->firstName,
            'advertisings' => Channel::all()->random()->name,
            'username' => $this->faker->userName,

        ];
    }
}
