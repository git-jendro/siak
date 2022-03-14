<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PelajaranSeeder::class);
        // $this->call(AgamaSeeder::class);
        // $this->call(JabatanSeeder::class);
        // $this->call(UserSeeder::class);
    }
}
