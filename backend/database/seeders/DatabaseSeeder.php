<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // 1) Create env variables to contain the number of Model that you want to seed in the .env
        // SEED_USERS_COUNT = 10
        // SEED_POSTS_COUNT = 10
        // ...

        // 2) Then you need to create a configuration file in config/name_of_the_file.php

        // 3) And then you need to create separately those items using the factory

        // 4) Finally to need to chain all the factories to create all the items
    }
}
