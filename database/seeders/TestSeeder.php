<?php

namespace Database\Seeders;

use App\Models\Advertising;
use App\Models\Channel;
use App\Models\MainChannel;
use App\Models\TelegramUser;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MainChannel::factory(2)->create();
        Advertising::factory(100)->create();
        TelegramUser::factory(100)->create();


    }
}
