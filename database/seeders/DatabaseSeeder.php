<?php

namespace Database\Seeders;

use App\Models\Push;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->truncate();
        Status::query()->truncate();
        Push::query()->truncate();

        User::factory(10)->create();
        Status::factory(5)->create();
        Push::factory(20)->create();
    }
}
